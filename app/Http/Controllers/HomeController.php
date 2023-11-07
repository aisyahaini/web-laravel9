<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    // fungsi untuk update password
    public function update_password()
    {
        $user = Auth::user();
        return view('update_password', compact('user'));
    }

    // fungsi untuk menyimpan password
    public function store_password(Request $request)
    {
        $request->validate([
            'new_password' => 'required|min:8|confirmed'
        ]);

        Auth::user()->update([
            'new_password' => Hash::make($request->new_password)
        ]);

        // membuat session
        $request->session()->flash('message', 'Succesfully change password');
        
        return Redirect::back();
    }
}
