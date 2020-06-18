<?php

namespace App\Http\Controllers;

use App\BlogPosts;
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
        return view('BlogPost.daftarblogpost', ['blogpost' => BlogPosts::all()]);
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
    public function store(Request $request)
    {

        /*
        ? Validasi Form Sederhana Tanpa Membuat File Request
         */

        $validatedData = $request->validate([
            'title' => 'required|max:100',
            'content' => 'required',
        ]);

        $blogpost = new BlogPosts();
        $blogpost->title = $request->post('title');
        $blogpost->content = $request->post('content');
        $blogpost->save();

        $request->session()->flash('status', 'News Was Created!');

        return redirect()->route('blogpost.show', ['blogpost' => $blogpost->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
