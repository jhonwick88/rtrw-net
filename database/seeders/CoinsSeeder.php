<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use DB;

class CoinsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $now = Carbon::now()->toDateTimeString();
        // $dataItems = [];
        // for ($i=0;$i<10;$i++){
        //     $dataItems[] = [
        //         'name' => 'Coins '.$i,
        //         'user_id' => $i % 2 == 0 ? 2 : 3,
        //         'logo' => 'bimp.png',
        //         'symbol' => 'BSC',
        //         'network_id' => $i % 2 == 0 ? 1 : 2,
        //         'ispresale' => $i % 2 == 0 ? 0 : 1,
        //         'contract_address' => '0xB8c77482e45F1F44dE1745F52C74426C631bDD5'.$i,
        //         'description' => 'Desc coins '.$i,
        //         'website_link' => 'https://example.com/'.$i,
        //         'launch_at' => $now,
        //         'telegram_link' => 'https://web.telegram.org',
        //         'status' => 1,
        //         'created_at' => $now,
        //         'updated_at' => $now
        //     ];
        // }
        // \DB::table('coins')->insert($dataItems);
        $coins = \App\Models\Coin::all();       
        foreach($coins as $item ){
            $item->slug = \Illuminate\Support\Str::of($item->name)->slug('-');
            $item->save();
        }
       // $now = \Carbon\Carbon::now()->toDateTimeString();
        // \DB::table('settings')->insert([
        //     ['label' => 'Body BG', 'key' => 'body_bg_color', 'value' => '#444444', 'type'=> 'color', 'description' => 'Insert body background color', 'setting_group_id' =>4, 'order' => 1, 'created_at' => $now, 'updated_at' => $now],    
        //     ['label' => 'Body Text', 'key' => 'body_text_color', 'value' => '#ffffff', 'type'=> 'color', 'description' => 'Insert body text color', 'setting_group_id' =>4, 'order' => 2, 'created_at' => $now, 'updated_at' => $now],    
        //     ['label' => 'Nav BG', 'key' => 'nav_bg_color', 'value' => '#444444', 'type'=> 'color', 'description' => 'Insert navigation background color', 'setting_group_id' =>4, 'order' => 3, 'created_at' => $now, 'updated_at' => $now],    
        //     ['label' => 'Nav menu', 'key' => 'nav_menu_color', 'value' => '#231234', 'type'=> 'color', 'description' => 'Insert navigation menu color', 'setting_group_id' =>4, 'order' => 4, 'created_at' => $now, 'updated_at' => $now],    
        //     ['label' => 'Nav active', 'key' => 'nav_active_color', 'value' => '#231234', 'type'=> 'color', 'description' => 'Navigation active menu color', 'setting_group_id' =>4, 'order' => 5, 'created_at' => $now, 'updated_at' => $now],    
        //     ['label' => 'Site title 1', 'key' => 'site_title1_color', 'value' => '#231234', 'type'=> 'color', 'description' => 'Insert site title 1 color', 'setting_group_id' =>4, 'order' => 6, 'created_at' => $now, 'updated_at' => $now],    
        //     ['label' => 'Site title 2', 'key' => 'site_title2_color', 'value' => '#231234', 'type'=> 'color', 'description' => 'Insert site title 2 color', 'setting_group_id' =>4, 'order' => 7, 'created_at' => $now, 'updated_at' => $now],    
        //     ['label' => 'Card BG Color', 'key' => 'card_bg_color', 'value' => '#231234', 'type'=> 'color', 'description' => 'Insert custom card background color', 'setting_group_id' =>4, 'order' => 8, 'created_at' => $now, 'updated_at' => $now],    
        //     ['label' => 'Footer Top BG', 'key' => 'footer_top_bg', 'value' => '#231234', 'type'=> 'color', 'description' => 'Insert footer top background color', 'setting_group_id' =>4, 'order' => 9, 'created_at' => $now, 'updated_at' => $now],    
        //     ['label' => 'Footer Bottom BG', 'key' => 'footer_bottom_bg', 'value' => '#231234', 'type'=> 'color', 'description' => 'Insert footer bottom background color', 'setting_group_id' =>4, 'order' => 10, 'created_at' => $now, 'updated_at' => $now],    
        //     ['label' => 'Footer Text Color', 'key' => 'footer_text_color', 'value' => '#ffffff', 'type'=> 'color', 'description' => 'Insert footer text color', 'setting_group_id' =>4, 'order' => 11, 'created_at' => $now, 'updated_at' => $now],                
        //     ]);   
    }
}
