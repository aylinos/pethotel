<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index() {
        return view('index');
    }

    public function signup() {
        return view('signup');
    }

    public function login() {
        return view('login');
    }
}
