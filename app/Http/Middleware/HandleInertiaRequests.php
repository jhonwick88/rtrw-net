<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;
use App\Models\Ads;
use App\Models\Setting;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request)
    {
        return parent::version($request);
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request)
    {
        // $ads_home = Ads::query()->ads(1)->inRandomOrder()->get();
        // $ads_detail = Ads::query()->ads(2)->inRandomOrder()->get();
        // $ads_default = Ads::query()->ads(3)->inRandomOrder()->get(); //default ads
        // if(count($ads_home) == 0){
        //     $ads_home = $ads_default;
        // }
        // if(count($ads_detail) == 0){
        //     $ads_detail = $ads_default;
        // }
        //$ads_home = $query->where('ads_type', 1)->get();
        //$ads_home = $query->get();
        //$ads_detail = '';
        // $query->where('deadline', '>=', now()->format('Y-m-d H:i:s'));
        // if(!$ads_home){
        //     $ads_home = Ads::where('ads_type', 3)->where('is_active',1)->first(); //default
        // }
        // $ads_detail = Ads::where('ads_type', 2)->where('is_active',1)->first();
        // if(!$ads_detail){
        //     $ads_detail = Ads::where('ads_type', 3)->where('is_active',1)->first(); //default
        // }
        $settings = Setting::select('key','value')->get();
        $data = collect($settings);
        $data = $data->mapWithKeys(function($item, $key) {
            return [$item->key => $item->value];
        });
        return array_merge(parent::share($request), [
            // 'ads_home' => $ads_home,
            // 'ads_detail' => $ads_detail,
            'settings' => $settings,
            'setting_new' => $data,
        ]);
    }
}
