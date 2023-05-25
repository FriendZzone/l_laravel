<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class ShowUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:show';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Show user information';

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
        // $header = ['Name', 'Email'];
        $users =  User::all(['name', 'email'])->toArray();
        $bar = $this->output->createProgressBar(count($users));

        $bar->start();

        foreach ($users as $user) {
            // $this->performTask($user);
            sleep(3);
            var_dump($user);
            $bar->advance();
        }

        $bar->finish();
        return 0;
    }
}
