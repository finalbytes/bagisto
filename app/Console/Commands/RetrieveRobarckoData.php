<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class RetrieveRobarckoData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'finalbytes:retrieve:robarcko';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Will retrieve all products data from Robarcko\'s API';

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
        $api_key    = env('ROBARCKO_API_KEY');
        $api_link   = env('ROBARCKO_API_LINK');

        $response = Http::withHeaders([
            'x-api-key' => $api_key,
            'Content-Type' => 'application/json; charset=utf-8'
        ])->get($api_link);

        if ( $response->successful() ) {
            Storage::disk('suppliers')->put('robarcko/orignal.json', $response->body());

            //TODO
            //JUST INFORM AND SEND AN EMAIL RETRIEVED NEW ROBARCKO ITEMS

            $this->call('finalbytes:generate:robarcko');
            return 1;
        }
        return 0;
    }
}
