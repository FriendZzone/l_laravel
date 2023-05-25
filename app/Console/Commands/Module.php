<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use File;

class Module extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:module {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new module';

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
        $name = $this->argument('name');
        if (File::exists(base_path('modules/' . $name))) {
            $this->error('Module already exists');
        } else {
            File::makeDirectory(base_path('modules/' . $name), 0755, true, true);
            $this->info('Module created successfully');
        }
        $path = 'modules';
        File:
        return 0;
    }
}
