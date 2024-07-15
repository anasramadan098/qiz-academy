<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // $credentials = $request->only('email', 'password');

        if (Auth::attempt(['username' => $request->username,'password' => $request->password])) {
            // اريده ان يرجع للصفحة الذي كان فيها

            return redirect('/me');
        } else {
            return redirect()->back()->withErrors(['email' => 'Invalid credentials']);
        }

    }
}
