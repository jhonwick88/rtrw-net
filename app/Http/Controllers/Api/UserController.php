<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseApiController;
use Illuminate\Http\Request;
use App\Http\Requests\Api\AddCoinRequest;
use App\Http\Requests\Api\AddVoteRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\Coin;
use App\Models\Vote;
use App\Traits\UploadFileHelper;
use Carbon\Carbon;

class UserController extends BaseApiController
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

    // public function store(AddCoinRequest $request)
    // {
    //     $data = new User();
    //     $data->name = $request->name;
    //     $data->symbol = $request->symbol;
    //     $data->network_id = $request->network_id;
    //     $data->contract_address = $request->contract_address;

    //     if ($request->hasFile('logo')) {
    //         $image = $this->uploadImg(Coin::UPLOAD_FOLDER, 'logo', $request, 100, 100);
    //         $data->logo = $image['name'];
    //     }

    //     $data->saveOrFail();

    //     return $this->successResponse($data);
    // }
    public function update(Request $request, $id)
    {
        $data = User::find($id);
        if ($request->has('is_active')) {
            $data->is_active  = $request->is_active;
        }
        if ($request->has('roles')) {
            $data->roles()->sync($request->roles);
        }

        $data->saveOrFail();
        $data->refresh();
        $data->load('roles');
        return $this->successResponse($data);
    }

    public function destroy($id)
    {
        $data = User::findOrFail($id);
        $data->delete();
        $data->load('roles');
        return $this->successResponse($data);
    }

    public function baseQuery(Request $request)
    {
        $query = User::query()->with(['roles']);
        if ($request->has('active')) {
            $query->where('is_active', true);
        }
        if ($request->has('q')) {
            $searchTerm = $request->q;
            $query->where('name', 'LIKE', "%{$searchTerm}%");
            $query->orWhere('email', 'LIKE', "%{$searchTerm}%");
            $query->orderBy('created_at','desc');
        }
        return $query;
    }


}
