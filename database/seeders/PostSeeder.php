<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker = Factory::create();

        DB::table('posts')->insert([
            'title' => $faker->realText(100),
            'content' => $faker->randomHtml(2, 3),
            'status' => rand(0, 1),
            'user_id' => 2,
            'created_at' => $faker->dateTime('Y-m-d H:i:s'),
            'updated_at' => $faker->dateTime('Y-m-d H:i:s')
        ]);
    }
}
