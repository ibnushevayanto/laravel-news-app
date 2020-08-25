<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ApiLoginRequest;
use App\User;
use Illuminate\Support\Facades\Hash;

class AuthenticationUserController extends Controller
{
    public function login(ApiLoginRequest $request)
    {
        $data = $request->validated();

        $user = User::where('email', $data['email'])->first();

        if (Hash::check($data['password'], $user->password)) {
            return [
                'success' => true,
                'message' => 'Berhasil Mendapatkan Data',
                'data' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'api_token' => $user->api_token,
                    'is_admin' => $user->is_admin
                ]
            ];
        } else {
            return [
                'success' => false,
                'message' => 'Gagal Mendapatkan Data'
            ];
        }
    }
}
