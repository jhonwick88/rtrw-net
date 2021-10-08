<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class adsEditSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = \App\Models\Ads::all();
        $datastart = [
            '2021-08-13 07:25:19',
            '2021-08-14 07:25:19',
            '2021-08-12 07:25:19',
            '2021-08-10 07:25:19',
            '2021-08-09 07:25:19',
            '2021-08-08 07:25:19'
        ];
        $dataend = [
            '2021-08-16 07:25:19',
            '2021-08-17 07:25:19',
            '2021-08-18 07:25:19',
            '2021-08-19 07:25:19',
            '2021-08-20 07:25:19',
            '2021-08-21 07:25:19'
        ];
        foreach($data as $item ){
            $item->start_date = $datastart[rand(0,5)];
            $item->end_date = $dataend[rand(0,5)];
            $item->save();
        }

    }
}
