<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class DefaultHomeController extends Controller
{
    public function index()
    {
        if(Auth::id())
        {
            $role=auth()->user()->role;

            if($role == '1')
            {
                return view('admin.dashboard');
            }

             else if($role == '0')
            {
                return view('sector.dashboard');
            }
            else
            {
                return redirect()->back();
            }
        }

       
    }
}
