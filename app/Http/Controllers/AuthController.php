<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Auth\Events\Logout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(LoginRequest $request){
        $data = $request->validated();
        if (Auth::attempt($data)) {
            $info['remember_token'] = Hash::make($data['email']. $data['password']. rand(0, 1));
            $user = User::where('email', $data['email'])->first();
            $user->update($info);
            return json_encode(['result'=>'success', 'remember_token'=>$info['remember_token']]);
        }
        return json_encode(['result'=>'error']);
    }

    public function register(RegisterRequest $request){
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
        $data['remember_token'] = Hash::make($data['email']. $data['password']. rand(0, 1));
        $user = User::create($data);
        return json_encode(['result'=>'success', 'remember_token'=>$user->remember_token]);
    }

    public function logout(Request $request){
        $data = $request->validate(['remember_token'=>'required|string']);
        $user = User::where('remember_token', $data['remember_token'])->first();
        if($user){
            $data['remember_token'] = null;
            $user->update($data);
            return json_encode(['result'=>'success']);
        }
        return json_encode(['result'=>'error']);
    }
}
