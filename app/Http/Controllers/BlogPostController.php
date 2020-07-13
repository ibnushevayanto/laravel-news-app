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
        return view('BlogPost.daftarblogpost', ['blogpost' => BlogPosts::withCount(['comments as jumlah_komentar'])->with('user')->get()]);
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
        return view('BlogPost.detailblogpost', ['blogpost' => BlogPosts::withCount('comments as jumlah_komentar')->with('comments')->findOrFail($id)]);
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

        if (Gate::denies('update-post', $post)) {
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

        if (Gate::denies('update-post', $post)) {
            abort(403);
        }

        $dataValidated = $request->validated();

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
        $request->session()->flash('status', $blogpost->title . ' was deleted');
        $blogpost->delete();
        return redirect()->route('blogpost.index');
    }
}
