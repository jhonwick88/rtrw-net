<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now()->toDateTimeString();
        \DB::table('settings')->insert([
            ['label' => 'Company Name', 'key' => 'company_name', 'value' => 'PintarMedia', 'description' => 'Insert your company name here(ex: PINTARMEDIA, CV)', 'setting_group_id' =>2, 'order' => 1, 'created_at' => $now, 'updated_at' => $now],    
            ['label' => 'Company Phone Number', 'key' => 'company_phone', 'value' => '082132935169', 'description' => 'Insert your company phone here(ex: +6282132935169)', 'setting_group_id' => 2, 'order' => 2, 'created_at' => $now, 'updated_at' => $now],    
            ['label' => 'Company Email 1', 'key' => 'company_email1', 'value' => 'ads@mydomain.net', 'description' => 'Insert your company email 1 here(ex: my@email1.com)', 'setting_group_id' => 2, 'order' => 3, 'created_at' => $now, 'updated_at' => $now],    
            ['label' => 'Company Email 2', 'key' => 'company_email2', 'value' => 'info@mydomain.net', 'description' => 'Insert your company email 2 here(ex: my@email2.com)', 'setting_group_id' => 2, 'order' => 4, 'created_at' => $now, 'updated_at' => $now],    
            ['label' => 'Company Address', 'key' => 'company_address', 'value' => 'Jln. Sukarno Bloc C JKT, 64471', 'description' => 'Insert your company address here', 'setting_group_id' => 2, 'order' => 5, 'created_at' => $now, 'updated_at' => $now],    
            ['label' => 'Site Name', 'key' => 'site_name', 'value' => 'Coin Beast', 'description' => 'Insert your site name here(ex: Coin Snipper)', 'setting_group_id' => 1, 'order' => 1, 'created_at' => $now, 'updated_at' => $now],    
            ['label' => 'Site Description', 'key' => 'site_description', 'value' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Corporis cupiditate cum recusandae libero, omnis ducimus tenetur facilis impedit doloribus excepturi itaque voluptate, illo eum, nihil corrupti eos sed ipsam ut!', 'description' => 'Insert your site description', 'setting_group_id' => 1, 'order' => 2, 'created_at' => $now, 'updated_at' => $now],  
            ['label' => 'Site Url', 'key' => 'site_url', 'value' => 'https://coinbeast.com', 'description' => 'Insert your site url here(ex: https://example.com)', 'setting_group_id' => 1, 'order' => 3, 'created_at' => $now, 'updated_at' => $now],    
            ['label' => 'Site Logo', 'key' => 'site_logo', 'value' => 'example_image.svg', 'description' => 'Use Image with SVG or PNG Format', 'setting_group_id' => 1, 'order' => 4, 'created_at' => $now, 'updated_at' => $now],    
            ['label' => 'Facebook Url', 'key' => 'facebook_url', 'value' => 'http://facebook.com', 'description' => 'Insert your Facebook url', 'setting_group_id' => 2, 'order' => 1,'created_at' => $now, 'updated_at' => $now],
            ['label' => 'Whatsapp Url', 'key' => 'whatsapp_url', 'value' => 'http://whatsapp.com', 'description' => 'Insert your Twitter url', 'setting_group_id' => 2, 'order' => 2,'created_at' => $now, 'updated_at' => $now],
            ['label' => 'Instagram Url', 'key' => 'instagram_url', 'value' => 'http://instagram.com', 'description' => 'Insert your Instagram url', 'setting_group_id' => 2, 'order' => 3,'created_at' => $now, 'updated_at' => $now],
            ['label' => 'Telegram Url', 'key' => 'telegram_url', 'value' => 'http://telegram.com', 'description' => 'Insert your Telegram url', 'setting_group_id' => 2, 'order' => 4,'created_at' => $now, 'updated_at' => $now],  
            ['label' => 'Twitter Url', 'key' => 'twitter_url', 'value' => 'http://twitter.com', 'description' => 'Insert your Twitter url', 'setting_group_id' => 2, 'order' => 5,'created_at' => $now, 'updated_at' => $now],  
        ]);   
    }
}
