<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseApiController;
use Illuminate\Http\Request;
use App\Http\Requests\Api\AddPaymentRequest;
use App\Models\Payment;
use App\Models\Customer;


class PaymentController extends BaseApiController
{
    public function index(Request $request)
    {
    //    $data = \Carbon\Carbon::now();
       //$data = \Carbon\Carbon::createFromFormat('d/m/Y H:i:s',  '19/02/2019 00:00:00');
    //    $data = array();
    //    for ($i = 11; $i >= 0; $i--) {
    //        $month = \Carbon\Carbon::today()->startOfMonth()->subMonth($i)->format('n');
    //        $year = \Carbon\Carbon::today()->startOfMonth()->subMonth($i)->format('Y');
    //        array_push($data, array(
    //            'month' => $month,
    //            'year' => $year
    //        ));
    //    }
    //    return $data->year;

        $query = $this->baseQuery($request);
        $perPage = 10;
        if ($request->has('limit')) {
            $perPage = $request->limit;
        }
        if ($request->has('all')) {
            $results = $query->get();
            $data = new \Illuminate\Pagination\LengthAwarePaginator($results, $results->count(), -1);
        }else{
            $data = $query->paginate($perPage);
        }
        return $this->successResponse($data);
    }

    public function store(AddPaymentRequest $request)
    {
        $data = new Payment();
        $data->month = $request->month;
        $data->pay_date = $request->pay_date;
        $data->total = $request->total;
        $data->user_id = $request->user()->id;
        $data->payment_method_id = $request->payment_method_id;
        $data->customer_id = $request->customer_id;
        $data->status = $request->status;
        $data->saveOrFail();
        $data->refresh();
        $data->load(['customer','user','paymentMethod']);
        return $this->successResponse($data);
    }

    public function update(Request $request, $id)
    {
        $data = Payment::find($id);
        $data->month = $request->month;
        $data->pay_date = $request->pay_date;
        $data->total = $request->total;
        $data->user_id = $request->user()->id;
        $data->payment_method_id = $request->payment_method_id;
        $data->customer_id = $request->customer_id;
        $data->status = $request->status;
        $data->saveOrFail();
        $data->refresh();
        $data->load(['customer','user','paymentMethod']);
        return $this->successResponse($data);
    }

    public function destroy($id)
    {
        $data = Payment::findOrFail($id);
        $data->delete();

        return $this->successResponse($data);
    }

    public function baseQuery(Request $request)
    {
        $query = Customer::query()->with(['payment' => function($q) use ($request){
            //$q->with('network');
            //if ($request->has('q')) {
                $searchTerm = \Carbon\Carbon::now();
                $q->where('month', $searchTerm->month);
                $q->where('year', $searchTerm->year);
                $q->orderBy('created_at','desc');
            //}
        },'network','server','customerMember']);

        if ($request->has('q')) {
            $searchTerm = $request->q;
            $query->where('name', 'LIKE', "%{$searchTerm}%");
           // $query->orWhere('adress', 'LIKE', "%{$searchTerm}%");
            $query->orderBy('created_at','desc');
        }
        return $query;
    }
}
