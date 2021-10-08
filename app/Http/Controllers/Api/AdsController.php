<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseApiController;
use Illuminate\Http\Request;
use App\Http\Requests\Api\AddAdsRequest;
use App\Models\Ads;
use App\Traits\UploadFileHelper;

class AdsController extends BaseApiController
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
        if ($request->has('status')) {
            return $this->successResponse($data, $request->status);
        }
        return $this->successResponse($data);
    }
    public function store(AddAdsRequest $request)
    {
        $data = new Ads();
        $data->ads_title = $request->ads_title;
        $data->ads_price = $request->ads_price;
        $data->ads_type = $request->ads_type;
        $data->ads_owner_name = $request->ads_owner_name;
        $data->ads_owner_email = $request->ads_owner_email;
        $data->ads_owner_phone = $request->ads_owner_phone;
        $data->ads_address = $request->ads_address;
        $data->ads_link = $request->ads_link;
        $data->is_active = $request->is_active;
        $data->start_date = $request->start_date;
        $data->end_date = $request->end_date;
        if ($request->hasFile('ads_image_url')) {
            $image = $this->uploadImg(Ads::UPLOAD_FOLDER, 'ads_image_url', $request, 730, 90);
            $data->ads_image_url = $image['name'];
        }
        $data->saveOrFail();
        return $this->successResponse($data);
    }
    public function update(Request $request, $id)
    {
        $data = Ads::find($id);
        $data->ads_title = $request->ads_title;
        $data->ads_price = $request->ads_price;
        $data->ads_type = $request->ads_type;
        $data->ads_owner_name = $request->ads_owner_name;
        $data->ads_owner_email = $request->ads_owner_email;
        $data->ads_owner_phone = $request->ads_owner_phone;
        $data->ads_address = $request->ads_address;
        $data->ads_link = $request->ads_link;
        $data->is_active = $request->is_active;
        $data->start_date = $request->start_date;
        $data->end_date = $request->end_date;
        if ($request->hasFile('ads_image_url')) {
            $image = $this->uploadImg(Ads::UPLOAD_FOLDER, 'ads_image_url', $request, 730, 90);
            $data->ads_image_url = $image['name'];
        }
        $data->saveOrFail();
        $data->refresh();
        return $this->successResponse($data);
    }
    public function updateActive(Request $request, $id)
    {
        $data = Ads::find($id);
        if ($request->has('is_active')) {
            $data->is_active  = $request->is_active;
        }
        $data->saveOrFail();
        $data->refresh();
        return $this->successResponse($data);
    }

    public function destroy($id)
    {
        $data = Ads::findOrFail($id);
        $data->delete();

        return $this->successResponse($data);
    }

    public function baseQuery(Request $request)
    {
        $query = Ads::query();
        if ($request->has('date_start')) {
            $query->where('start_date', '>=' ,$request->date_start);
        }
        if ($request->has('date_end')) {
            $query->where('end_date', '<=' ,$request->date_end);
        }
        if ($request->has('active')) {
            $query->where('is_active', true);
        }
        if ($request->has('q')) {
            $searchTerm = $request->q;
            $query->where('ads_owner_phone', 'LIKE', "%{$searchTerm}%");
            $query->orWhere('ads_owner_name', 'LIKE', "%{$searchTerm}%");
            $query->orderBy('created_at','desc');
        }
        return $query;
    }
}
