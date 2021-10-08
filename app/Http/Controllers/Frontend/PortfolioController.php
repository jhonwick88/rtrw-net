<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use Inertia\Inertia;

class PortfolioController extends Controller
{
    public function index(){
        return Inertia::render('Frontend/Portfolio',[
            'appname' => 'Portfolio',
            'header_title' => 'Portfolio',
            'sub_title' => 'Track the value of your BEP-20 tokens!'
        ]);
    }
}
