<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Exception;
use App\Models\Ads;

class AdsCheck extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ads:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command to check expire of ads customers and will be not active';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Init Checking Ads');
        logger()->info('Checking Ads starting....');
        try {
            $data = Ads::where('end_date','<',now()->format('Y-m-d H:i:s'))
            ->where('is_active',1)->get();
            if ($data){
                $this->info('Checking Ads starting.....');
                $x = 0;
                foreach ($data as $item){
                    $item->is_active = 0;
                    $item->save();
                    $this->info('Checking Ads ['.$x.']');
                    $x++;
                }
            }
            $this->info('Init Checking Ads Complete');
        }catch(Exception $e){
            logger()->info('Ads error!!! : '.$e->getMessage());
        }
        
    }
}
