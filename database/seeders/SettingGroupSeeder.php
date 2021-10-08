<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class SettingGroupSeeder extends Seeder
{
    
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now()->toDateTimeString();

        \DB::table('setting_groups')->insert([
            //  ['id' => 1, 'name' => 'Site', 'description' => 'Site settings', 'created_at' => $now, 'updated_at' => $now],
            //  ['id' => 2, 'name' => 'Company', 'description' => 'Company settings', 'created_at' => $now, 'updated_at' => $now],
            //  ['id' => 3, 'name' => 'Sosial Media', 'description' => 'Sosmed settings', 'created_at' => $now, 'updated_at' => $now],             
              ['id' => 4, 'name' => 'Custom Color', 'description' => 'Site Color settings', 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}
