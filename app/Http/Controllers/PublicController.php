<?php

namespace App\Http\Controllers;

use App\Models\Outlet;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index()
    {
        return view('frontend.index');
    }

    public function aboutUs()
    {
        return view('frontend.about-us');
    }


    public function branches()
    {
        $outlets = Outlet::with('district')->get();
        return view('frontend.branches', compact('outlets'));
    }

    public function contactUs()
    {
        return view('frontend.contact-us');
    }
}
