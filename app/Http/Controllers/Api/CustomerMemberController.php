<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseApiController;
use Illuminate\Http\Request;
use App\Http\Requests\Api\AddCustomerMemberRequest;
use App\Http\Requests\Api\UpdateNetworkRequest;
use App\Models\CustomerMember;


class CustomerMemberController extends BaseApiController
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

    public function store(AddCustomerMemberRequest $request)
    {
        $data = new CustomerMember();
        $data->name = $request->name;
        $data->password = $request->password;
        $data->extra_price = $request->extra_price;
        $data->customer_id = $request->customer_id;
        $data->note = $request->note;

        $data->saveOrFail();
        $data->load(['customer']);
        return $this->successResponse($data);
    }

    public function update(UpdateNetworkRequest $request, $id)
    {
        $data = CustomerMember::find($id);
        $data->name = $request->name;
        $data->password = $request->password;
        $data->extra_price = $request->extra_price;
        $data->customer_id = $request->customer_id;
        $data->note = $request->note;
        $data->saveOrFail();
        $data->refresh();
        $data->load(['customer']);
        return $this->successResponse($data);
    }

    public function destroy($id)
    {
        $data = CustomerMember::findOrFail($id);
        $data->delete();

        return $this->successResponse($data);
    }

    public function baseQuery(Request $request)
    {
        $query = CustomerMember::query()->with(['customer' => function($q) use ($request){
            if ($request->has('q')) {
                $searchTerm = $request->q;
                $q->where('name', 'LIKE', "%{$searchTerm}%");
                $q->orWhere('adress', 'LIKE', "%{$searchTerm}%");
                $q->orderBy('created_at','desc');
            }
        }]);
        return $query;
    }
}
