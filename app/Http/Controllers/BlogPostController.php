<?php

namespace App\Http\Controllers;

use App\BlogPosts;
use App\Http\Requests\PostRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Cache;

class BlogPostController extends Controller
{

    public function __construct()
    {
        /* 
            * Cara Mengamankan Route Dengan Menggunakan Controller
            ? Attribute Yang Bisa Digunakan Ialah 
            ! only([]) dan except([])

            * contoh penggunaan
            ! $this->middleware('auth')->only(['create', 'store]);
        */

        $this->middleware('auth')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // * Cara menggunakan local query scope liat method latest pada code dibawah ini
        // ? Cara menggunakan local query scope pada child relation, liat method show. with comments
        $data = Cache::tags(['blog-post'])->remember('all-blogpost', 600, function () {
            return BlogPosts::latest()->withCount(['comments as jumlah_komentar'])->with(['user', 'tags'])->get();
        });

        // * Cara membuat cache

        // * Automatis terdeteksi logic dari cache
        // * Logic nya ialah Jika ada di cache akan mengambil dari cache jika tidak akan fetch dari database
        // * Parameter pertama dari cache::remember adalah nama dari cache tersebut
        // * Parameter kedua dari cache::remember adalah waktu tersimpannya cache tersebut. [Dalam hitungan sekon]
        // * Parameter ketiga dari cache::remember adalah data yang ingin disimpan

        $mostCommented = Cache::tags(['blog-post'])->remember('most-commented', 600, function () {
            return BlogPosts::mostCommented()->take(5)->get();
        });

        return view('BlogPost.daftarblogpost', [
            'blogpost' => $data,
            'most_commented' => $mostCommented
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('BlogPost.tambahblogpost');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {

        /*
        ? Validasi Form Sederhana Tanpa Membuat File Request
        ? Bail Akan Menampilkan Validation Error Satu Satu
         */

        // * Kode

        // $validatedData = $request->validate([
        //     'title' => 'bail|required|max:100',
        //     'content' => 'bail|required',
        // ]);

        /*
        ? End Of Request Validation
         */

        $validatedData = $request->validated();
        $validatedData['user_id'] = $request->user()->id;

        $blogpost = BlogPosts::create($validatedData);

        $request->session()->flash('status', 'News Was Created!');

        return redirect()->route('blogpost.show', ['blogpost' => $blogpost->id]);
    }

    /**
     * Display the specifie
     * ''\d resource.
     *
     * @param  int  $id\[po]
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // * Cara pertama menggunakan query local scope pada relation with

        // $data = BlogPosts::withCount('comments as jumlah_komentar')->with(['comments' => function ($query) {
        //     return $query->latest();
        // }])->findOrFail($id);

        // * Cara kedua menggunakan query local scope pada child relation adalah dengan langsung pada methods comments di BlogPosts Model. silahkan dicheck

        $data = Cache::tags(['blog-post'])->remember("blog-post-{$id}", 600, function () use ($id) {
            return BlogPosts::withCount('comments as jumlah_komentar')->with(['comments' => function ($query) {
                $query->with('user');
            }, 'tags', 'user'])->findOrFail($id);
        });

        // ? Start fitur siapa yang sedang melihat blogpost

        // * Untuk mendapatkan user session [Tidak perlu login untuk mendapatkan user session]
        $sessionId = session()->getId();

        // * Mengambil cache jika tidak ada akan cache berupa array kosong
        $usersKey = "blog-post-{$id}-users";
        $users = Cache::tags(['blog-post'])->get($usersKey, []);

        // * Tempat menyimpan semua users yang sedang melihat
        $usersUpdate = [];

        $diffrence = 0;
        $now = now();

        foreach ($users as $session => $lastVisit) {
            /*
                * Cache dari variabel $users dilooping
                * logicnya jika waktu users dari waktu sekarang dengan value lebih dari satu menit
                * maka akan dibaca expired
                * jika tidak akan disimpan di tempat penyimpanan sementara yaitu variable $usersUpdate
            */
            if ($now->diffInMinutes($lastVisit) >= 1) {
                $diffrence--;
            } else {
                $usersUpdate[$session] = $lastVisit;
            }
        }

        /*
            * Jika didalam cache $users masih fresh atau tidak ada key yang sama dengan $sessionId
            * Atau ada yang sama keynya tetapi sudah expired maka akan dibuat kembali
            * Ini karena pada saat foreach diatas kita menghilangkan karena sudah expired dan dibuat yang baru
        */
        if (
            !array_key_exists($sessionId, $users) ||
            $now->diffInMinutes($users[$sessionId]) >= 1
        ) {
            $diffrence++;
        }

        // * store ke array dengan waktu sekarang
        $usersUpdate[$sessionId] = $now;

        // * Store ke cache selamanya nilai dari $usersUpdate
        Cache::tags(['blog-post'])->forever($usersKey, $usersUpdate);

        /* 
            * Jika cache tidak punya key seperti variable $counterKey
            * Maka akan membuat cache dengan key $counterKey 
            * Kenapa harus melakukan itu ? 
            * Karena logic diatas kita hanya mengecheck yang sudah satu menit atau yang sudah expired jadi kita harus membuat baru
            * Jika sudah ada maka nilai akan di increment dari nilai diffrence
        */
        $counterKey = "blog-post-{$id}-counter";
        if (!Cache::tags(['blog-post'])->has($counterKey)) {
            Cache::tags(['blog-post'])->forever($counterKey, 1);
        } else {
            Cache::tags(['blog-post'])->increment($counterKey, $diffrence);
        }

        $watched = Cache::tags(['blog-post'])->get($counterKey);
        // ? End fitur siapa yang sedang melihat blogpost

        return view('BlogPost.detailblogpost', ['blogpost' => $data, 'watched' => $watched]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = BlogPosts::findOrFail($id);

        /* 
            ? Gate::denies
            ? Adalah jika kondisi ditolak akan menghasilkan nilai boolean
        */

        // * Jikalau Policy Sudah Didaftarkan Check Di AuthServiceProvider.php line 15
        if (Gate::denies('update', $post)) {
            abort(403, 'You cant edit the blogpost');
        }

        return view('BlogPost.editblogpost', ['blogpost' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, $id)
    {

        $post = BlogPosts::findOrFail($id);

        if (Gate::denies('update', $post)) {
            abort(403);
        }

        $dataValidated = $request->validated();
        $dataValidated['user_id'] = $request->user()->id;

        /*
            ? Wajib Menggunakan find() Tidak Boleh Menggunakan where() 
            ? Agar Ketrigger Pada Model Event Update
        */

        $post->update($dataValidated);

        $request->session()->flash('status', 'News Was Edited!');

        return redirect()->route('blogpost.show', ['blogpost' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $blogpost = BlogPosts::findOrFail($id);

        // * Cara Kedua Dalam Memberifikasi Authorization Selain Gate::denies() / Gate::allows()
        // $this->authorize('blogpost.delete', $blogpost);

        // * Jikalau Policy Sudah Didaftarkan Check Di AuthServiceProvider.php line 15
        $this->authorize('delete', $blogpost);

        $request->session()->flash('status', $blogpost->title . ' was deleted');
        $blogpost->delete();
        return redirect()->route('blogpost.index');
    }
}
