<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class LoginController extends Controller
{
    public function login()
    {
        return Inertia::render('Auth/Login',[
            'appname' => 'Admin Login'
        ]);
    }
    public function template()
    {
        return Inertia::render('Backend/Newtheme',[
            'appname' => 'Admin Okree'
        ]);
    }
}
