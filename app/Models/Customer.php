<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    const UPLOAD_FOLDER = 'images/customers';
    protected $fillable = [
        'name',
        'adress',
        'phone',
        'photo',
        'discount',
        'server_id',
        'network_id',
        'status',
    ];
    protected $appends = ['network_type','total_payment'];

    public function customerMember()
    {
        return $this->hasMany(CustomerMember::class);
    }
    public function payment()
    {
        return $this->hasMany(Payment::class);
    }
    public function network()
    {
        return $this->belongsTo(Network::class);
    }
    public function server()
    {
        return $this->belongsTo(Server::class);
    }
    private function voucherCalculation(){
        $totalAmount = 0;
        foreach ($this->customerMember as $key) {
            $totalAmount += $key->extra_price;
        }
        if (count($this->customerMember) == 2){
            $totalAmount -= count($this->customerMember)*5000;
        }
        if(count($this->customerMember) == 3){
            $totalAmount -= 2 * 5000;
        }
        if(count($this->customerMember) >= 4){
            $totalAmount -= count($this->customerMember)*10000;
        }
        return $totalAmount;
    }
    public function getNetworkTypeAttribute(){
        return Network::listNetworkType()[$this->network->network_type];
    }
    public function getTotalPaymentAttribute(){
        switch ($this->network->network_type) {
            case Network::TYPE_PPPOE:
                return $this->network->price - $this->discount;
                break;
            case Network::TYPE_VOUCHER:
                return $this->network->price * count($this->customerMember) + $this->voucherCalculation() - $this->discount;
                break;
            default:
                return 0;
                break;
            }
    }

}
