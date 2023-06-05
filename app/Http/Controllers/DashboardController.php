<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        if(Auth::user()->hasRole('admin'))
        {
            return redirect()->route('admin-dashboard');
        }elseif(Auth::user()->hasRole('seller'))
        {
            return redirect()->route('seller-dashboard');
        }elseif(Auth::user()->hasRole('user'))
        {
            return redirect()->route('user-dashboard');
        }
    }
}
