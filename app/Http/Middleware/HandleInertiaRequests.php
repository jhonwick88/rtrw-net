<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;
use App\Models\Ads;
use App\Models\Setting;
use Auth;
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

        $settings = Setting::select('key','value')->get();
        $data = collect($settings);
        $data = $data->mapWithKeys(function($item, $key) {
            return [$item->key => $item->value];
        });
        // Inertia::share('auth.user', function () {
        //     return Auth::user();
        // });
        return array_merge(parent::share($request), [
            // 'ads_home' => $ads_home,
            // 'ads_detail' => $ads_detail,
            'settings' => $settings,
            'setting_new' => $data,
            'isAdmin' => Auth::user() ? Auth::user()->roles[0]->title == 'Admin' ? true : false : false,
        ]);
    }
}
