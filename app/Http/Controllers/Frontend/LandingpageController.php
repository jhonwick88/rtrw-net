<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Ads;

class LandingpageController extends Controller
{
    public function snipper(){
        return Inertia::render('Auth/LoginNet',[
            'appname' => 'Admin Login'
        ]);
    }
    public function contact(){
        return Inertia::render('Landingpage/Contact',[
            'appname' => 'My Website | Contact Us'
        ]);
    }
    public function about(){
        return Inertia::render('Landingpage/About',[
            'appname' => 'My Website | About Us'
        ]);
    }
}
