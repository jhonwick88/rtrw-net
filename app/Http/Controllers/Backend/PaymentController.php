<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class PaymentController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return Inertia::render('Backend/PaymentList',[
            'appname' => 'Daftar Laporan Pembayaran',
            'title' => 'Laporan Pembayaran'
        ]);
    }
    public function create(){
        return Inertia::render('Backend/PaymentCreate',[
            'appname' => 'Form Pembayaran',
            'title' => 'Laporan Pembayaran'
        ]);
    }
}
