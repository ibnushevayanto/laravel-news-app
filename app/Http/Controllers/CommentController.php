<?php

namespace App\Http\Controllers;

use App\BlogPosts;
use App\Comment;
use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Comment as CommentResource;
use Illuminate\Support\Carbon;

class CommentController extends Controller
{

    public function __construct()
    {
        setlocale(LC_TIME, 'id_ID');
        Carbon::setLocale('id');
        $this->middleware('auth')->only(['store', 'edit', 'update', 'destroy']);
    }

    public function index(BlogPosts $blogpost)
    {

        // * Mendapatkan Semua Data BlogPost
        $data = $blogpost->comments()->with('user')->get();

        return CommentResource::collection($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogPosts $blogpost, CommentRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['user_id'] = Auth::id();

        $blogpost->comments()->create($validatedData);

        $request->session()->flash('status', 'Komentar berhasil dibuat');

        return redirect()->route('blogpost.show', ['blogpost' => $blogpost->id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BlogPosts $blogpost, CommentRequest $request)
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
