<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Ads;

class LandingpageController extends Controller
{
    public function snipper(Request $request){
        //$user->tokens()->where('id', $user->currentAccessToken()->id)->delete();
      // return \Auth::user()->currentAccessToken->delete();

        //return $ads_home;
        return Inertia::render('Landingpage/Snipper',[
            'appname' => 'Snipper Home',
            'header_title' => 'Best Coins Today',
            'sub_title' => 'Find the top voted coins of the last 24 hours',
            'coinsby' => 'today',
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
