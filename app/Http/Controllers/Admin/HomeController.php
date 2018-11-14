<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    //
    public function index()
    {
        return view('admin.dashboard');
    }

    public function sysconfig()
    {
        return view('admin.partial_sysconfig');
    }

    public function sysuser()
    {
        return view('admin.partial_sysuser');
    }

    public function general()
    {
        return view('admin.partial_general');
    }

    public function buttons()
    {
        return view('admin.partial_buttons');
    }

    public function panels()
    {
        return view('admin.partial_panels');
    }
}
