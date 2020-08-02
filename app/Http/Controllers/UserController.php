<?php

namespace App\Http\Controllers;

use App\BlogPosts;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');

        // * Parameter Pertama authorizeResource adalah Model dan parameter kedua adalah parameter yang dipakek
        $this->authorizeResource(User::class, 'user');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $blogpost = Cache::tags(['blog-post'])->remember("blogpost-user-{$user->id}", 600, function () use ($user) {
            return BlogPosts::where('user_id', '=', $user->id)->get();
        });
        return view('User.showuser', ['user' => $user, 'blogpost' => $blogpost]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('User.edituser', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        $validatedData = $request->validated();
        $user->update($validatedData);

        $hasfile = $request->hasFile('fotoprofil');

        if ($hasfile) {
            $file = $request->file('fotoprofil');
            $path = Storage::disk('public')->put('profiles', $file);

            if ($user->image) {
                Storage::disk('public')->delete($user->image->path);
                $user->image()->update(['path' => $path]);
            } else {
                $user->image()->create(['path' => $path]);
            }
        }

        $request->session()->flash('status', 'Profil Berhasil Diedit !');

        return redirect()->route('user.show', ['user' => $user->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
