<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register.index', [
            "title" => "Register"
        ]);
    }

    public function store(Request $request)
    {
       $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'min:5', 'max:255', 'regex:/[a-z]/', 'unique:users'],
            'email' => ['required', 'string', 'email:dns', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'address' => ['required', 'max:255'],
            'phonenumber' => ['required', 'numeric', 'min:11']
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);
        
        return redirect('/login')->with('success', 'Registration successfull, please login.');
    }
}
