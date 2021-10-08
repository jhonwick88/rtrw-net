<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseApiController;
use Illuminate\Http\Request;
use App\Http\Requests\Api\UpdateSettingRequest;
use App\Models\SettingGroup;
use App\Models\Setting;
use App\Traits\UploadFileHelper;

class SettingController extends BaseApiController
{
    use UploadFileHelper;
/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = $this->baseQuery($request);
        $query->orderBy('created_at','desc');
        $perPage = 10;
        if ($request->has('limit')) {
            $perPage = $request->limit;
        }
        if ($request->has('all')) {
            $data = $query->get();
        }elseif ($request->has('single')) {
            $data = $query->first();
        }else{
            $data = $query->paginate($perPage);
        }
        return $this->successResponse($data);
    }

    public function getSettings(){
        $query = Setting::query();
        $query->select('key','value');
        $data = $query->get();
        return $this->successResponse($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function baseQuery($request)
    {
        $query = SettingGroup::query()->with(['setting']);
        if ($request->has('key')) {
            $key = $request->key;
            $query->whereHas('setting', function ($childQuery) use ($key) {
                return $childQuery->where('key', $key);
            });
        }
        if ($request->has('name')) {
            $query->where(function ($childQuery) use ($request) {
                $search = $request->search;
                return $childQuery->where('name', 'like', "%{$search}%");
            });
        }
        return $query;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSettingRequest $request, $setting)
    {
        $request->validated();
        $query = Setting::find($setting);
        if ($request->hasFile('image')) {
            $image = $this->uploadImg(Setting::UPLOAD_FOLDER, 'image', $request);
            $query->value = $image['name'];
        }else{
            $query->value = $request->value;
        }        
        $query->save();
        return $this->successResponse($query);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}