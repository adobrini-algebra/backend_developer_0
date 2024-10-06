<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function show()
    {
        return view('admin.auth.login.show');
    }

    public function login()
    {
        //validate
        $data = request()->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        // create session
        if(Auth::attempt($data) === false){
            throw ValidationException::withMessages(['email' => 'Vasi podatci ne odgovaraju nicumu u nasoj bazi']);
        }

        // session()->regenerate();
        Session::regenerateToken();

        //rediect
        return redirect()->route('dashboard');
    }

    public function logout()
    {
        // create session
        Auth::logout();

        Session::invalidate();

        //rediect
        return redirect()->route('home');
    }
}
