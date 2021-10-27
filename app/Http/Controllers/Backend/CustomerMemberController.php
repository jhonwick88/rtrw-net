<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class CustomerMemberController extends Controller
{
    public function index($id)
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return Inertia::render('Backend/CustomerMemberList',[
            'appname' => 'Daftar Anggota',
            'title' => 'Anggota'
        ]);
    }
    public function create(){
        return Inertia::render('Backend/CustomerCreate',[
            'appname' => 'Form Tambah Pelanggan',
            'title' => 'Tambah Pelanggan'
        ]);
    }

}
