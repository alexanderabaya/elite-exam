<?php

namespace App\Http\Controllers;

use App\Models\ForgotPassword;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    public function index(){
        return view('auth.forgot-password.index');
    }

    public function reset($uuid, $token){

        $forgotPassword = ForgotPassword::where('uuid', $uuid)->where('token', $token)
        ->whereBetween('created_at', [now()->subMinutes(30), now()])
        ->first();

        if(!$forgotPassword){
            abort(401);
        }

        return view('auth.forgot-password.reset', [
            'forgotPassword' => $forgotPassword
        ]);
    }
}
