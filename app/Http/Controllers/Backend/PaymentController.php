<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Payment;
use App\Models\PaymentMethod;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->filters = [
            'months' => Payment::monthsList(),
            'years' => Payment::yearsList(),
        ];
        $this->searchTerm = \Carbon\Carbon::now();
        $this->default = [
            'month' => $this->searchTerm->month,
            'year' => $this->searchTerm->year
        ];
    }
    public function index()
    {
        // abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $methods = PaymentMethod::select('id','name')->where('status',1)->get();
        return Inertia::render('Backend/PaymentList',[
            'appname' => 'Daftar Laporan Pembayaran',
            'title' => 'Laporan Pembayaran',
            'filters' => $this->filters,
            'default' => $this->default,
            'methods' => $methods
        ]);
    }
    public function create(){
        return Inertia::render('Backend/PaymentCreate',[
            'appname' => 'Form Pembayaran',
            'title' => 'Laporan Pembayaran',
            'filters' => $this->filters,
            'default' => $this->default
        ]);
    }
}
