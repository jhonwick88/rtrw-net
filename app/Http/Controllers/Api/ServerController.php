<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseApiController;
use Illuminate\Http\Request;
use App\Http\Requests\Api\AddServerRequest;
use App\Models\Server;


class ServerController extends BaseApiController
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

    public function store(AddServerRequest $request)
    {
        $data = new Server();
        $data->name = $request->name;
        $data->location = $request->location;
        $data->serial_number = $request->serial_number;
        $data->model = $request->model;
        // $data->activate_date = $request->activate_date;
        $data->status = 1;

        $data->saveOrFail();

        return $this->successResponse($data);
    }

    public function update(Request $request, $id)
    {
        $data = Server::find($id);
        $data->name = $request->name;
        $data->location = $request->location;
        $data->serial_number = $request->serial_number;
        $data->model = $request->model;
        // $data->activate_date = $request->activate_date ?? null;
        // $data->status = $request->status ?? '';
        $data->saveOrFail();
        $data->refresh();
        return $this->successResponse($data);
    }

    public function destroy($id)
    {
        $data = Server::findOrFail($id);
        $data->delete();

        return $this->successResponse($data);
    }

    public function baseQuery(Request $request)
    {
        $query = Server::query();
        if ($request->has('q')) {
            $searchTerm = $request->q;
            $query->where('name', 'LIKE', "%{$searchTerm}%");
            $query->orWhere('location', 'LIKE', "%{$searchTerm}%");
            $query->orderBy('created_at','desc');
        }
        return $query;
    }
}
