<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Address;
use App\Models\Contact;
use App\Models\Report;

class UserController extends Controller
{
    public function get_user()
    {

        $users = User::where('role','user')
                 ->get(); 
        return view('client.index', ['users' => $users]); 
    }


    public function show($id)
    {
        $client = User::find($id);        
        $addresses = Address::where('user_id', $id)->get();       
        return view('client.show', compact('client', 'addresses'));
    }


    public function get_contact()
    {

        $contacts = Contact::all(); 
        
        return view('contact', ['contacts' => $contacts]); 
    }

    public function get_report()
    {

        $reports = Report::all(); 
        return view('report', ['reports' => $reports]); 
    }

    public function softDelete(Report $report)
    {
        
        $report->delete();
       
        return back()->with('success', 'Report soft deleted successfully.');
    }
}
