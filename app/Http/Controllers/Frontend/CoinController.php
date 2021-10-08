<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coin;
use App\Models\Watchlist;
use App\Models\Network;
use Inertia\Inertia;

class CoinController extends Controller
{
    public function filter($filter = 'today'){
        switch ($filter){
            case 'today':
                $header_title = 'Best Coins Today';
                $sub_title = 'Find the top voted coins of the last 24 hours';
                break;
            case 'alltime':
                $header_title = 'All Time Best';
                $sub_title = 'The coins with the most votes over all time';
                break;
            case 'new':
                $header_title = 'New Listings';
                $sub_title = 'New listings need 500 votes to be accepted';
                break;
            case 'marketcap':
                $header_title = 'Coins By Marketcap';
                $sub_title = 'From the biggest winners to the smallest gems';
                break;
            case 'presales':
                $header_title = 'Coins In Presale Phase';
                $sub_title = 'These coins are still in presale phase';
                break;
            default:
            $header_title = 'Best Coins Today';
            $sub_title = 'Find the top voted coins of the last 24 hours';
        }
        return Inertia::render('Landingpage/Snipper',[
            'appname' => 'Coin filter by '.$filter,
            'header_title' => $header_title,
            'sub_title' => $sub_title,
            'coinsby' => $filter
        ]);
    }
    public function search(){
        return Inertia::render('Frontend/SearchPage',[
            'appname' => 'Coin search',
        ]);
    }
    public function updateForm(){
        return Inertia::render('Frontend/UpdateForm',[
            'appname' => 'Coin Update Form',
        ]);
    }
    public function submit(){
        $network = Network::all();
        return Inertia::render('Frontend/CoinSubmit',[
            'appname' => 'Snipper | Coin submit',
            'network' => $network
        ]);
    }
    public function detail($slug)
    {
        //$arr = explode('-',$coin_name);
        $coins = Coin::with(['vote','network'])->where('slug',$slug)->firstOrFail();
       // return $coins;
        $watchlist = Watchlist::where('coin_id',$coins->id)->get();
        return Inertia::render('Frontend/CoinDetail', [
            'appname' => 'Coin '.$coins->name,
            'coins' => $coins,
            'watchlist' => $watchlist,
        ]);
    }
    public function home()
    {
        return Inertia::render('Frontend/CoinDetail', [
            'appname' => 'TETST ',
    
        ]);
    }
}
