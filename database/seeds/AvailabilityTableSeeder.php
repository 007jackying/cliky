<?php

use Illuminate\Database\Seeder;
use App\Models\Availability;

class AvailabilityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(Availability::where('name','=','In-Stock')->first() === null) {
            $inStock = Availability::create([
               'name' => 'In-Stock'
            ]);
        }
        if(Availability::where('name','=','Back in Stock')->first() === null) {
            $backStock = Availability::create([
               'name'=>'Back in Stock'
            ]);
        }
        if(Availability::where('name','=','Price Change')->first() === null) {
            $priceStock = Availability::create([
               'name' => 'Price Change'
            ]);
        }
    }
}
