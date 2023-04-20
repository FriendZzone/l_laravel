<?php

namespace App\Console\Commands;

use App\Models\User;
use Faker\Factory;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class UserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'create a new user';

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
        $faker = Factory::create();
        $user = new User();
        $user->name = $faker->name;
        $user->email = $faker->email;
        $user->password = Hash::make('12345678');
        $user->created_at = $faker->dateTime('Y-m-d H:i:s');
        $user->updated_at = $faker->dateTime('Y-m-d H:i:s');
        $user->save();

        $this->info("Create user $user->id successfully!");
        return true;
    }
}
