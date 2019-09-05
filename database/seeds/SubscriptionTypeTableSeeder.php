<?php

use Illuminate\Database\Seeder;
use App\Models\Subscription_Type;

class SubscriptionTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(Subscription_Type::where('name','=','Trial')->first() === null) {
            $trial = Subscription_Type::create([
                'name' => 'Trial'
            ]);
        }
        if(Subscription_Type::where('name','=','Subscribed')->first() === null) {
            $subscribed = Subscription_Type::create([
                'name'=>'Subscribed'
            ]);
        }
    }
}
