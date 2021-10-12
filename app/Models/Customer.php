<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'adress',
        'phone',
        'photo',
        'extra_price',
        'discount',
        'shared_user',
        'server_id',
        'network_id',
        'status',
    ];
    public function customerMember()
    {
        return $this->hasMany(CustomerMember::class);
    }
    public function network()
    {
        return $this->belongsTo(Network::class);
    }
    public function server()
    {
        return $this->belongsTo(Server::class);
    }

}
