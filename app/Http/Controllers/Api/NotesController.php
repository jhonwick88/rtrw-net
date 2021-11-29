<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseApiController;
use Illuminate\Http\Request;
use App\Http\Requests\Api\AddNoteRequest;
use App\Http\Requests\Api\UpdateNoteRequest;
use App\Models\Note;

class NotesController extends BaseApiController
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

    public function store(AddNoteRequest $request)
    {
        $data = new Note();
        $data->name = $request->name;
        $data->isdone = $request->isdone?? 0;
        $data->description = $request->description ?? "";
        $data->saveOrFail();

        return $this->successResponse($data);
    }

    public function update(UpdateNoteRequest $request, $id)
    {
        $data = Note::find($id);
        $data->name = $request->name;
        $data->isdone = $request->isdone?? 0;
        $data->description = $request->description ?? "";

        $data->saveOrFail();
        $data->refresh();
        return $this->successResponse($data);
    }

    public function destroy($id)
    {
        $data = Note::findOrFail($id);
        $data->delete();

        return $this->successResponse($data);
    }

    public function baseQuery(Request $request)
    {
        $query = Note::query();
        if ($request->has('q')) {
            $searchTerm = $request->q;
            $query->where('name', 'LIKE', "%{$searchTerm}%");
            $query->orderBy('created_at','desc');
        }
        return $query;
    }
}
