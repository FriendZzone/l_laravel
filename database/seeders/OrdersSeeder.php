<?php

namespace Database\Seeders;

use App\Models\Orders;
use Faker\Factory;
use Illuminate\Database\Seeder;

class OrdersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for ($i = 0; $i < 20; $i++) {

            $faker = Factory::create();
            $order = new Orders();
            $order->amount = $faker->randomNumber(4);
            $order->note = $faker->text(40);
            $order->save();
        }
    }
}
