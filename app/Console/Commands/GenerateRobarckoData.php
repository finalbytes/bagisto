<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GenerateRobarckoData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'finalbytes:generate:robarcko';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will generate all data from the \'just\' retrieved robarcko data';

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


    }
}
