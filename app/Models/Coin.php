<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coin extends Model
{
    use HasFactory;
    const UPLOAD_FOLDER = 'images/coins';
    const TYPE_LISTED_COIN = 1;
    const TYPE_NEW_COIN = 2;
    protected $fillable = [
        'user_id',
        'name',
        'slug',
        'logo',
        'symbol',
        'network_id',
        'ispresale',
        'ispromoted',
        'contract_address',
        'description',
        'cart_link',
        'swap_link',
        'website_link',
        'launch_at',
        'telegram_link',
        'twitter_link',
        'discord_link',
        'status',
        'presale_link',
        'marketcap',
        'price_usd',
        'price_bnb',
        'options',
    ];
    protected $appends = ['votes','status_label','added','launch_on'];

    public function getLogoAttribute()
    {
        return asset(self::UPLOAD_FOLDER.'/'.$this->attributes['logo']);
    }

    public function network()
    {
        return $this->belongsTo(Network::class);
    }

    public function vote(){
        return $this->hasMany(Vote::class);
    }

    public function getVotesAttribute(){
        if ($this->vote == null){
            return [
                'all' => 0,
                'today' => 0
            ];
        } 
        $data = array();
        foreach($this->vote as $v){
            if ($v->created_at->isToday()){
                $data[] = $v;
            }
        }
        return [
            'all' => count($this->vote),
            'today' => count($data)
        ];
    }
    public static function typeStatus(){
        return [
            self::TYPE_LISTED_COIN => 'Listed',
            self::TYPE_NEW_COIN => 'New',
        ];
    }

    public function getStatusLabelAttribute(){
        $status =  'UNKNOWN';
        foreach ($this->typeStatus() as $key => $value) {
            if($this->status == $key){
                $status = $value;
            }
        }
        return $status;
    }
    public function getAddedAttribute(){
        return $this->created_at->diffForHumans();
    }
    public function getLaunchOnAttribute(){
        $parse = \Carbon\Carbon::parse($this->launch_at);
        return $parse->diffForHumans();
    }

    // public function getNetworkIdAttribute()
    // {
    //     //$name = $this->network['name'];
    //     return $this->network;
    // }

}
