<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminHome extends Controller
{
    public function create(){

        return view('admin.dashboard');
    }
}
