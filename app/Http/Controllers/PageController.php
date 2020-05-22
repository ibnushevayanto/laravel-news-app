<?php

namespace App\Http\Controllers;

class PageController extends Controller
{
    public function landing()
    {
        return view('Landing.landing');
    }

    public function contact()
    {
        return view('Contact.contact');

    }
}
