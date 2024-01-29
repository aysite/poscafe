<?php

namespace App\Http\Controllers;

use App\Models\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    
    function index()
    {
        // Jika Sudah Login
        // User langsung diarahkan ke dashboard
        if(Auth::check()){
            return redirect("/");
        }
        // Jika belum login maka akan ditampilkan ke form login
        return view('auth.login');
    }

    function cek_login(Request $request){

        // Validasi
        $request->validate(
            [
                // Rule
                "email" => "required|email",
                "password" => "required"
            ],
            [
                // Message
                "email.required" => "Must be filled in !",
                "email.email" => "Email Not Valid !",
                "password.required" => "Must be filled in !"
            ]
        );

        // Proses Authentication
        if(Auth::attempt(['email' => $request->input('email'), 'password'=>$request->input('password')])){
            // Jika Berhasil Login
            $request->session()->regenerate();
            return redirect('/');
        }

        // Jika Gagal
        $notif = [
            'type' => "danger",
            "text" => "Username atau Password Salah !"
        ];
    
        return back()->with("notif",$notif);
    }

    function cek_logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect(route('auth.login'));
    }
}
