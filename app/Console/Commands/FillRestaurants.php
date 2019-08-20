<?php

namespace App\Console\Commands;

use App\Restaurant;
use Illuminate\Console\Command;

class FillRestaurants extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'restaurants:fill';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fill the database with restaurants';

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
     * @return mixed
     */
    public function handle()
    {
        $restaurant1 = new Restaurant();
        $restaurant1->name = "Aoyama";
        $restaurant2 = new Restaurant();
        $restaurant2->name = "PANCOOK Lille";
        $restaurant3 = new Restaurant();
        $restaurant3->name = "ROZO";

        $restaurant1->save();
        $restaurant2->save();
        $restaurant3->save();

        $this->info('Restaurants created');
    }
}
