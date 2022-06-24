<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact.index', [
            "title" => "Contact"
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email:dns'],
            'subject' => ['required'],
            'body' => ['required']
        ]);

        Message::create($validatedData);

        Alert::success('Success', 'Your message was sent successfully!');
        return redirect('/contact');
    }
}