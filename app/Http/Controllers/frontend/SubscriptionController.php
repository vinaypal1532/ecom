<?php

namespace App\Http\Controllers\frontend;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Subscriber;
use App\Mail\SubscriptionConfirmation;
use Illuminate\Support\Facades\Mail;

class SubscriptionController extends Controller
{
    

    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:subscribers,email',
        ]);

        Subscriber::create([
            'email' => $request->input('email'),
        ]);

        Mail::to($request->input('email'))->send(new SubscriptionConfirmation($request->input('email')));
       // return redirect()->route('subscribe.form')->with('status', 'Thank you for subscribing!');
    }
}
