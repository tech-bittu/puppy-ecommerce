<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
class StaticPageController extends Controller
{
    
    public function home():View
    {
        return view('Web.static.home');
    }
    public function dashboard(Request $request):View
    {
        return view('web.user.dashboard',[
            'user' => $request->user(),
        ]);
    }
    public function about():View
    {
        return view('web.about');
    }
    public function contact():View
    {
        return view('web.contact');
    }
    public function privacy():View
    {
        return view('web.privacy');
    }
    public function term():View
    {
        return view('web.term-condition');
    }
}
