<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseApiController;
use Illuminate\Http\Request;
use App\Http\Requests\Api\AddPaymentMethodRequest;
use App\Models\PaymentMethod;

class PaymentMethodController extends BaseApiController
{
    public function index(Request $request)
    {
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

    public function store(AddPaymentMethodRequest $request)
    {
        $data = new PaymentMethod();
        $data->name = $request->name;
        $data->account_number = $request->account_number;
        $data->description = $request->description;
        $data->status = $request->status;
        $data->saveOrFail();

        return $this->successResponse($data);
    }

    public function update(Request $request, $id)
    {
        $data = PaymentMethod::find($id);
        $data->name = $request->name;
        $data->account_number = $request->account_number;
        $data->description = $request->description;
        $data->status = $request->status;
        $data->saveOrFail();
        $data->refresh();
        return $this->successResponse($data);
    }

    public function destroy($id)
    {
        $data = PaymentMethod::findOrFail($id);
        $data->delete();

        return $this->successResponse($data);
    }

    public function baseQuery(Request $request)
    {
        $query = PaymentMethod::query();
        return $query;
    }
}
