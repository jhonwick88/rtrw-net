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
    protected $appends = ['collector'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function getCollectorAttribute(){
        return $this->user->name;
    }
    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }

}
