<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $role = $user->hasRole('jayusman');
        if ($role) {

            return view('dashboard.jayusman');
        }
        return view('dashboard.cabang',compact('user'));
    }
}
