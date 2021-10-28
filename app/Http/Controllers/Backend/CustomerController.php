<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Customer;
use App\Models\Network;
use App\Models\Server;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class CustomerController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $networks = Network::all();
        return Inertia::render('Backend/CustomerList',[
            'appname' => 'Daftar Pelanggan',
            'title' => 'Pelanggan',
            'networks' => $networks
        ]);
    }
    public function create(){
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $networks = Network::all();
        $servers = Server::all();
        $query = Customer::query()->with(['network','server','customerMember']);
        $customers = $query->get();
       // return $networks;
        return Inertia::render('Backend/CustomerCreate',[
            'appname' => 'Form Tambah Pelanggan',
            'title' => 'Tambah Pelanggan',
            'networks' => $networks,
            'customers' => $customers,
            'servers' => $servers
        ]);
    }
    public function member($id)
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $customer = Customer::with('customerMember')->where('id',$id)->first();
        return Inertia::render('Backend/CustomerMemberList',[
            'appname' => 'Daftar Anggota '. $customer->name,
            'title' => 'Anggota '.$customer->name,
            'customer' => $customer
        ]);
    }
    public function createMember($id){
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $customer = Customer::with('customerMember')->where('id',$id)->firstOrFail();
       // return $customer;
        return Inertia::render('Backend/CustomerMemberCreate',[
            'appname' => 'Form Tambah Anggota',
            'title' => 'Tambah Pelanggan'
        ]);
    }

}
