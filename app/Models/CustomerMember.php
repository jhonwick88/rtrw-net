<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerMember extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'extra_price',
        'customer_id',
        'note',
    ];
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
