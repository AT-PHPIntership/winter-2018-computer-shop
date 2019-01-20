<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublicController extends Controller
{
    /**
     * Display a homepage of website.
     *
     * @return Homepage view
     */
    public function homepage()
    {
        return view('public.page.homepage');
    }
}
