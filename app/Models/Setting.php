<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    const UPLOAD_FOLDER = 'images/site';
    protected $guarded = [];
    public function getValueAttribute($value)
    {
        if($this->key == 'site_logo'){
          return asset(self::UPLOAD_FOLDER.'/'.$value);
        }
        return $value;
       
    }
}
