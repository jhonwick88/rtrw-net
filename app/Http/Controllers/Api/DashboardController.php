<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseApiController;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Customer;
use App\Models\Server;
use App\Models\Network;


class DashboardController extends BaseApiController
{
    public function index()
    {
        $data = [
            'tot_pelanggan' => Customer::count(),
            'tot_user' => User::count(),
            'tot_server' => Server::count(),
            'tot_jaringan' => Network::count()
        ];
        return $this->successResponse($data);
    }


}
