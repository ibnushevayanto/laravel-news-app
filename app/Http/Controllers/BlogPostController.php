<?php

namespace App\Http\Controllers;

use App\BlogPosts;
use App\Http\Requests\PostRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

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
        $data = BlogPosts::latest()->withCount(['comments as jumlah_komentar'])->with('user')->get();
        return view('BlogPost.daftarblogpost', ['blogpost' => $data]);
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
        // * Cara pertama menggunakan query local scope pada child relation
        // $data = BlogPosts::withCount('comments as jumlah_komentar')->with(['comments' => function ($query) {
        //     return $query->latest();
        // }])->findOrFail($id);

        // * Cara kedua menggunakan query local scope pada child relation adalah dengan langsung pada methods comments di BlogPosts Model. silahkan dicheck
        $data = BlogPosts::withCount('comments as jumlah_komentar')->with('comments')->findOrFail($id);

        return view('BlogPost.detailblogpost', ['blogpost' => $data]);
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
