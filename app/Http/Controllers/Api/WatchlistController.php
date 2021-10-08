<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseApiController;
use Illuminate\Http\Request;
use App\Http\Requests\Api\AddWatchlistRequest;
use App\Models\Watchlist;
use App\Models\Coin;
use Illuminate\Support\Facades\Gate;
use DB;

class WatchlistController extends BaseApiController
{
    public function index(Request $request)
    {
        //$user = $request->user();
        $query = $this->baseQuery($request);
        // if(!Gate::check('task_access')){
        //     $query->where(['user_id' => $user->id]);
        // }
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


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddWatchlistRequest $request)
    {
        $user = $request->user();
        try{
            DB::beginTransaction();
            $wishlist = Watchlist::updateOrCreate(
                ['user_id'=>$user->id,'coin_id'=>$request->coin_id],
                ['coin_id'=>$request->coin_id]
            );
           
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            return $this->failedResponse($th->getMessage());
        }

        return $this->successResponse($wishlist);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($watchlist)
    {
        $data = Watchlist::where('user_id',\Auth::user()->id)->where('coin_id',$watchlist)->first();
        //return $this->successResponse($data);
        if ($data) {
            $data->delete();
            return $this->successResponse($data);
        }

        return $this->failedResponse('Failed to delete');
    }
    public function delete($id)
    {
        $data = Watchlist::find($id);
        if ($data) {
            $data->delete();
            return $this->successResponse($data);
        }
        return $this->failedResponse('Failed to delete');
    }
    public function baseQuery(Request $request)
    {
        $query = Watchlist::query()->with(['coin' => function($q) use ($request){
            $q->with('network');
            if ($request->has('q')) {
                $searchTerm = $request->q;
                $q->where('name', 'LIKE', "%{$searchTerm}%");
                $q->orWhere('description', 'LIKE', "%{$searchTerm}%");
                $q->orderBy('created_at','desc');
            }
        }]);
        //$query->whereHave('coin','!=',null);

        return $query;
    }
}
