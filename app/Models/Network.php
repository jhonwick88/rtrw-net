<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Network extends Model
{
    use HasFactory;

    const TYPE_PPPOE = 1;
    const TYPE_VOUCHER = 2;
    protected $fillable = [
        'name',
        'rate_limit',
        'price',
        'network_type',
    ];
    protected $appends = ['network_type_label'];

    public static function listNetworkType(){
        return [
            self::TYPE_PPPOE => 'PPPOE',
            self::TYPE_VOUCHER => 'VOUCHER',
        ];
    }
    public function getNetworkTypeLabelAttribute(){
        $network_type =  'UNKNOWN';
        foreach ($this->listNetworkType() as $key => $value) {
            if($this->network_type == $key){
                $network_type = $value;
            }
        }
        return $network_type;
    }
}
