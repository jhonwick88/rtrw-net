<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Coin;
use App\Models\Network;

class CoinController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $network = Network::all();
        return Inertia::render('Backend/CoinList',[
            'appname' => 'Admin CoinList',
            'network' => $network
        ]);
    }
}
