<?php

namespace App\Console\Commands;

use App\Core\DemoSendEmail;
use Illuminate\Console\Command;

class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:send {userEmail:user email address}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'send email';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public $demoSend;
    public function __construct(DemoSendEmail $demoSend)
    {
        parent::__construct();
        $this->demoSend = $demoSend;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        echo $this->demoSend->sendEmail($this->argument('userEmail'));
        $name = $this->ask('What is your name?');
        echo $name . ' input successfully';
        $password = $this->secret('What is the password?');
        echo $password . ' password successfully';
        $confirm = $this->confirm('Do you wish to continue?');
        echo $confirm ? 'Y' : 'N' . ' confirm password';
        $choice = $this->choice(
            'What is your name?',
            ['Taylor', 'Dayle'],
            1
        );
        echo $choice . ' choice successfully';
        return "email sent";
    }
}
