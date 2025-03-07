<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $contactUs = Contact::latest()->get();
        return view('backend.admin.contact-us.index',compact('contactUs'));
    }
}
