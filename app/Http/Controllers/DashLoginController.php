<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashLoginController extends Controller
{
    public function index()
    {
        return view ('admin.login_dashboard');   
    }
}
