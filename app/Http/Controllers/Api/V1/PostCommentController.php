<?php

namespace App\Http\Controllers\Api\V1;

use App\BlogPost;
use App\BlogPosts;
use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use Illuminate\Http\Request;
use App\Http\Resources\Comment as CommentResource;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class PostCommentController extends Controller
{
    public function __construct()
    {
        setlocale(LC_TIME, 'id_ID');
        Carbon::setLocale('id');
        // $this->middleware('auth')->only(['store', 'edit', 'update', 'destroy']);
    }

    public function index(BlogPosts $blogpost, Request $request)
    {
        // * Jika tidak ada parameter per_page maka nilai perPage akan default 100
        $perPage = $request->input('per_page') ?? 100;

        /*
        ? cara membuat pagination

        * paginate parameternya adalah data yang ingin ditampilkan dalam satu page
        * appends adalah untuk memberi custom parameter yang ingin digunakan, ini akan mempengharuhi url pada next button pagination
        */
        $data = $blogpost->comments()->with('user')->paginate($perPage)->appends(
            ['per_page' => $perPage]
        );

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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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
