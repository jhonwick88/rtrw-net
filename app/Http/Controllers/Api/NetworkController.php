<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseApiController;
use Illuminate\Http\Request;
use App\Http\Requests\Api\AddNetworkRequest;
use App\Models\Network;

class NetworkController extends BaseApiController
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

    public function store(AddNetworkRequest $request)
    {
        $data = new Network();
        $data->name = $request->name;
        $data->rate_limit = $request->rate_limit;
        $data->price = $request->price;
        $data->network_type = $request->network_type;
        $data->saveOrFail();

        return $this->successResponse($data);
    }

    public function update(Request $request, $id)
    {
        $data = Network::find($id);
        $data->name = $request->name;
        $data->rate_limit = $request->rate_limit;
        $data->price = $request->price;
        $data->network_type = $request->network_type;
        $data->saveOrFail();
        $data->refresh();
        return $this->successResponse($data);
    }

    public function destroy($id)
    {
        $data = Network::findOrFail($id);
        $data->delete();

        return $this->successResponse($data);
    }

    public function baseQuery(Request $request)
    {
        $query = Network::query();
        return $query;
    }
}
