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
        //TODO put this in config file
        $api_key    = '941742a6-3259-4ecc-9736-c8b784b6972e';
        $api_link   = 'https://robarcko-webshop-api.azurewebsites.net/Api/Products/';

        $response = Http::withHeaders([
            'x-api-key' => $api_key,
        ])->get($api_link);

        if ($response->successful()) {
            $data = $response->body();

            Storage::disk('local')->put('robarcko.txt', "\xEF\xBB\xBF" .$data);

            //TODO
            //JUST INFORM AND SEND AN EMAIL RETRIEVED NEW ROBARCKO ITEMS

            $this->call('finalbytes:generate:robarcko');
            return 1;
        }
        return 0;
    }
}
