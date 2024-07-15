<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// User Model
use App\Models\User;

class RegisterController extends Controller
{
    public function register(Request $req) {
        $islog = true;
        $user = new User();
        $user->full_name = $req->fname . ' ' . $req->lname;
        $user->gender = $req->gender;
        $user->date = $req->date;
        $user->email = $req->email;
        $user->phone = $req->phone;
        $user->username = $req->username;

        // Get Role If Has
        if ($req->has('role')) {
            $user->role = $req->role;
            $islog = false;
        };
        

    
        //  Hased Password
        $user->password = bcrypt($req->password);
    
        $user->street_1 = $req->street_1;
        $user->street_2 = $req->street_2;
        $user->city = $req->city;
        $user->zip = $req->zip;
        $user->state = $req->state;
        $user->country = $req->country;
    
        
        $user->save();

        if ($islog != true) {
            return redirect()->back();
        }
        Auth::login($user);
        return redirect('/');
        
    }
}
