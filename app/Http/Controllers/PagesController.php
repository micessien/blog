<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    // # process variable data or params
        # talk to the model
        # Recieve from the model
        # Compile or process data from the model if needed
        # pass that data to the correct view

    public function getIndex()
    {
        return view("pages.welcome");
    }

    public function getAbout()
    {
        return view("pages.about");
    }

    public function getContact()
    {
        return view("pages.contact");
    }
}
