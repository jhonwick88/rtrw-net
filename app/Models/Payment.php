<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = [
        'month',
'pay_date',
'total',
'user_id',
'payment_method_id',
'customer_id',
'status',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }

}
