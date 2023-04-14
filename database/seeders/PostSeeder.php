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

        for ($i = 0; $i < 50; $i++) {
            DB::table('posts')->insert([
                'title' => $faker->realText(100),
                'content' => $faker->randomHtml(2, 3),
                'user_id' => rand(2, 4),
                'created_at' => $faker->dateTime('Y-m-d H:i:s'),
                'updated_at' => $faker->dateTime('Y-m-d H:i:s')
            ]);
        }
    }
}
