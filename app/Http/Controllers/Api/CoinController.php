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

class CoinController extends BaseApiController
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
    
    public function store(AddCoinRequest $request)
    {
        $data = new Coin();
        $data->name = $request->name;
        $data->slug = \Illuminate\Support\Str::of($request->name)->slug('-');
        $data->symbol = $request->symbol;
        $data->network_id = $request->network_id;
        $data->contract_address = $request->contract_address;
        $data->website_link = $request->website_link;
        $data->description = $request->description;
        $data->ispresale = $request->ispresale;        
        $data->presale_link = $request->presale_link;
        $data->cart_link = $request->cart_link;
        $data->swap_link = $request->swap_link;
        $data->launch_at = $request->launch_at;
        $data->telegram_link = $request->telegram_link;
        $data->twitter_link = $request->twitter_link;
        $data->discord_link = $request->discord_link;
        $data->user_id = $request->user()->id;

        if ($request->hasFile('logo')) {
            $image = $this->uploadImg(Coin::UPLOAD_FOLDER, 'logo', $request, 100, 100);
            $data->logo = $image['name'];
        }

        $data->saveOrFail();

        return $this->successResponse($data);
    }
    public function update(Request $request, $id)
    {
        $data = Coin::find($id);
        $data->name = $request->name;
        $data->slug = \Illuminate\Support\Str::of($request->name)->slug('-');
        $data->symbol = $request->symbol;
        $data->network_id = $request->network_id;
        $data->contract_address = $request->contract_address;
        $data->website_link = $request->website_link;
        $data->description = $request->description;
        $data->ispresale = $request->ispresale;        
        $data->presale_link = $request->presale_link;
        $data->cart_link = $request->cart_link;
        $data->swap_link = $request->swap_link;
        $data->marketcap = $request->marketcap;
        $data->price_usd = $request->price_usd;
        $data->price_bnb = $request->price_bnb;
        $data->launch_at = $request->launch_at;
        $data->ispromoted = $request->ispromoted;
        $data->telegram_link = $request->telegram_link;
        $data->twitter_link = $request->twitter_link;
        $data->discord_link = $request->discord_link;
        $data->user_id = $request->user_id;

        if ($request->hasFile('logo')) {
            $image = $this->uploadImg(Coin::UPLOAD_FOLDER, 'logo', $request, 100, 100);
            $data->logo = $image['name'];
        }
        $data->saveOrFail();
        $data->refresh();
        $data->load(['network']);
        return $this->successResponse($data);
    }

    public function destroy($id)
    {
        $data = Coin::findOrFail($id);
        $data->delete();

        return $this->successResponse($data);
    }

    public function baseQuery(Request $request)
    {
        $query = Coin::query()->with(['network']);
        // $query->whereHas('product', function ($childQuery) {
        //     $childQuery->with('brand');
        // });
        if ($request->has('status')) {
            $st = $request->status;
            switch($st){
                case 'today': $query->whereDate('launch_at', '=', Carbon::today()->toDateString()); break;
                case 'alltime': $query->orderBy('created_at','desc'); break;
                case 'new': $query->orderBy('launch_at','desc'); break;
                case 'marketcap': 
                    $query->where('ispresale',0);
                    $query->orderBy('launch_at','desc'); 
                    break;
                case 'presales':
                    $query->where('ispresale',1);
                    $query->orderBy('launch_at','desc'); 
                    break;
            }
            
        }
        if ($request->has('pr')){
            $query->where('ispromoted', true);
        }
        if ($request->has('active')) {
            $query->where('is_active', true);
        }
        if ($request->has('ispresale')) {
            $query->where('ispresale', true);
        }
        if ($request->has('q')) {
            $searchTerm = $request->q;
            $query->where('name', 'LIKE', "%{$searchTerm}%");
            $query->orWhere('description', 'LIKE', "%{$searchTerm}%");
            $query->orderBy('created_at','desc');
        }
        return $query;
    }

    public function addVotes(AddVoteRequest $request){
        $user = $request->user();
        //check
        $vote = Vote::where('user_id',$user->id)
        ->where('coin_id',$request->coin_id)
        ->whereDate('created_at',Carbon::today())
        ->first();
        if(!$vote){
            $newVote = new Vote();
            $newVote->user_id = $user->id;
            $newVote->coin_id = $request->coin_id;
            $newVote->vote_date = Carbon::now()->toDateTimeString();
            $newVote->save();
            return $this->successResponse([],null,'Thanks you for your votes');
        }
        return $this->successResponse([],null,'You can vote once every 24 hours only');
        
    }
}
