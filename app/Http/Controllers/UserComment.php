<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest;
use App\User;
use Illuminate\Support\Facades\Auth;

class UserComment extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(User $user, CommentRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['user_id'] = Auth::id();

        $user->comments()->create($validatedData);

        $request->session()->flash('status', 'Komentar berhasil dibuat');

        return redirect()->route('user.show', ['user' => $user->id]);
    }
}
