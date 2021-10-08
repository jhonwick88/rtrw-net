<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;


class Ads extends Model
{
    use HasFactory;
    const UPLOAD_FOLDER = 'images/ads';
    const TYPE_HOME = 1; // home ads
    const TYPE_DETAIL = 2; // details ads
    const TYPE_DEFAULT = 3; // show default ads if no any ads available
    protected $fillable = ['ads_title','ads_price','ads_type','ads_owner_name','ads_owner_email','ads_owner_phone','ads_address','ads_image_url','ads_link','is_active','start_date','end_date'];

    protected $appends = ['ads_type_label'];

    public function getAdsImageUrlAttribute()
    {
        return asset(self::UPLOAD_FOLDER.'/'.$this->attributes['ads_image_url']);
    }
    public static function adsType(){
        return [
            self::TYPE_DEFAULT => 'Default',
            self::TYPE_HOME => 'Home',
            self::TYPE_DETAIL => 'Detail',
            
        ];
    }

    public function getAdsTypeLabelAttribute(){
        $status =  'UNKNOWN';
        foreach ($this->adsType() as $key => $value) {
            if($this->ads_type == $key){
                $status = $value;
            }
        }
        return $status;
    }
    // $query->where('deadline', '>=', now()->format('Y-m-d H:i:s'));
    // $query->where('date_start', '>=' , \Carbon\Carbon::now()->startOfDay());
    // $query->where('date_end', '<=' , \Carbon\Carbon::now()->endOfDay());
    public function scopeAds($query,$type){
        Log::info('scopeAds '.now()->format('Y-m-d H:i:s'));
       $query->where('start_date', '<=', now()->format('Y-m-d H:i:s'));
       $query->where('end_date', '>=', now()->format('Y-m-d H:i:s'));
       $query->where('ads_type', $type);
        $query->where('is_active', 1);
        return $query;
    }
    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }
}
