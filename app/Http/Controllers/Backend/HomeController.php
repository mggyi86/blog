<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;


class HomeController extends BackendController
{

    public function index()
    {
        return view('home');
    }
}
