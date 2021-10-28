<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class NetworkController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return Inertia::render('Backend/NetworkList',[
            'appname' => 'Daftar Jaringan',
            'title' => 'Jaringan'
        ]);
    }
    public function create(){
        return Inertia::render('Backend/NetworkCreate',[
            'appname' => 'Form Tambah Jaringan',
            'title' => 'Jaringan'
        ]);
    }
}
