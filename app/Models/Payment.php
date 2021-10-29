<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = [
        'pay_date',
        'total',
        'user_id',
        'payment_method_id',
        'customer_id',
        'status',
        'month',
        'year'
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
    public static function monthsList(){
        return [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember'
        ];
    }
    public static function yearsList(){
        return [
            2021 => '2021',
            2022 => '2022',
            2023 => '2023',
            2024 => '2024',
            2025 => '2025'
        ];
    }

}
