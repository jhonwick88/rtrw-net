<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Http\Requests\Api\AddCustomerRequest;
use App\Traits\UploadFileHelper;
use App\Models\Customer;
use App\Models\CustomerMember;


class CustomerController extends BaseApiController
{
    use UploadFileHelper;
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

    public function store(AddCustomerRequest $request)
    {
        $data = new Customer();
        $data->name = $request->name;
        $data->adress = $request->adress;
        $data->phone = $request->phone;
       // $data->extra_price = $request->extra_price;
        $data->discount = $request->discount;
       // $data->shared_user = $request->shared_user;
        $data->server_id = $request->server_id;
        $data->network_id = $request->network_id;
        $data->status = $request->status;

        if ($request->hasFile('photo')) {
            $image = $this->uploadImg(Customer::UPLOAD_FOLDER, 'photo', $request);
            $data->photo = $image['name'];
        }
        $data->saveOrFail();
        if(count($request->members) > 1){
            $customerMembers = new Collection();
            foreach ($request->members as $row) {
               $customerMembers->push(
                   new CustomerMember([
                    'name' => $row['name'],
                    'password' => $row['password'],
                    'extra_price' => $row['extra_price']
               ])
                );
            }
            $data->customerMember()->saveMany($customerMembers);
        }
        $data->refresh();
        $data->load(['network','server','customerMember']);
        return $this->successResponse($data);
    }

    public function update(Request $request, $id)
    {
        $data = Customer::find($id);
        $data->name = $request->name;
        $data->adress = $request->adress;
        $data->phone = $request->phone;
        //$data->extra_price = $request->extra_price;
        $data->discount = $request->discount;
        //$data->shared_user = $request->shared_user;
        $data->server_id = $request->server_id;
        $data->network_id = $request->network_id;
        $data->status = $request->status;

        if ($request->hasFile('photo')) {
            $image = $this->uploadImg(Customer::UPLOAD_FOLDER, 'photo', $request);
            $data->photo = $image['name'];
        }

        $data->saveOrFail();
        $data->refresh();
        $data->load(['network','server','customerMember']);
        return $this->successResponse($data);
    }

    public function destroy($id)
    {
        $data = Customer::findOrFail($id);
        $data->customerMember()->delete();
        $data->payment()->delete();
        $data->delete();

        return $this->successResponse($data);
    }

    public function baseQuery(Request $request)
    {
        $query = Customer::query()->with(['network','server','customerMember']);
        if ($request->has('q')) {
            $searchTerm = $request->q;
            $query->where('name', 'LIKE', "%{$searchTerm}%");
            $query->orWhere('adress', 'LIKE', "%{$searchTerm}%");
            $query->orderBy('created_at','desc');
        }
        return $query;
    }
}
