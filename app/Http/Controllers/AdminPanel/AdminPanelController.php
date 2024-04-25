<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class AdminPanelController extends Controller
{
    //
    public function home():RedirectResponse
    {
        if(Auth::guard('admin')->check())
        {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('admin.login');
    }
    public function dashboard()
    {
        return view('admin.dashboard');
    }
}
