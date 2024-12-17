<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function double($number)
    {
        return $number * 2;
    }

    public function name($name)
    {
        return "Hello, " . $name;
    }

    public function logMe()
    {
        return "Request Logged";
    }
}
