<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coin;
use App\Models\User;
use App\Models\Watchlist;
use App\Models\Network;
use Inertia\Inertia;

class WatchlistController extends Controller
{
    public function index(){
        $query = Watchlist::query()->with(['coin' => function($q){
            $q->with('network');
        }]);
        $query->where('user_id',\Auth::user()->id);
        $watchlist = $query->get();
        $public_link = route('fe.watchlist.most', ['public_id' => \Auth::user()->public_link]);
        return Inertia::render('Frontend/MyWatchlist',[
            'appname' => 'My Watchlist',
            'watchlist' => $watchlist,
            'public_link' => $public_link,
            'header_title' => 'Watchlist',
            'sub_title' => 'Follow your favorite coins and tokens!',
        ]);
    }
    public function most($public_id){
        $user = User::where('public_link',$public_id)->first();
        if($user){
            $query = Watchlist::query()->with(['coin' => function($q){
                $q->with('network');
            }]);
            $query->where('user_id',$user->id);
            $watchlist = $query->get();
            return Inertia::render('Frontend/MyWatchlist',[
                'appname' => 'Friends Watchlist',
                'watchlist' => $watchlist,
                'header_title' => 'Friends Watchlist',
                'sub_title' => 'Follow your favorite coins and tokens!',
            ]);
        }
        return abort(403, 'Unauthorized action.');
    }
}
