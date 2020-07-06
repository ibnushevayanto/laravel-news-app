<?php

namespace App\Http\Controllers;

use App\BlogPosts;
use App\Http\Requests\PostRequest;
use Illuminate\Http\Request;

class BlogPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('BlogPost.daftarblogpost', ['blogpost' => BlogPosts::withCount(['comments as jumlah_komentar'])->get()]);
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
        return view('BlogPost.detailblogpost', ['blogpost' => BlogPosts::findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('BlogPost.editblogpost', ['blogpost' => BlogPosts::findOrFail($id)]);
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
        $dataValidated = $request->validated();
        $blogpost = BlogPosts::whereId($id)->update($dataValidated);

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
