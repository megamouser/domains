<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use GuzzleHttp\Client;

class GrabParams extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:grabparams {number}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'grab all statistic params for domains without params';

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
     * @return mixed
     */
    public function handle()
    {
        ini_set("memory_limit", "-1");
        set_time_limit(12000);

        $numberArgument = $this->argument('number');
        $currentProcessId = DB::table("processes")->insertGetId(["name" => "collecting-$numberArgument", "status" => "runned", "runned_at" => date("Y-m-d H:i:s")]);

        $domainsWithoutParams = DB::table("domains")->where("json_params")->get();

        while ($domainsWithoutParams) 
        {
            try {
                $domainsWithoutParams = $domainsWithoutParams->chunk("500")[$numberArgument];
            } catch (\Throwable $th) {
                DB::table("processes")->truncate();
            }

            foreach ($domainsWithoutParams as $key => $domainWithoutParams) 
            {
                try {
                    $client = new Client();
                    $response = $client->request('GET', 'https://seo-rank.my-addr.com/api2/moz+alexa+sr+fb/1BAFA8ED4032A9DAFE1DEB9D0BD6AE6F/' . $domainWithoutParams->name);
                    $json = json_encode(json_decode($response->getBody()));
                    DB::table('domains')->where('name', $domainWithoutParams->name)->update(["name" => $domainWithoutParams->name, "da" => json_decode($json)->da, "pa" => json_decode($json)->pa, "moz" => json_decode($json)->mozrank, "links" => json_decode($json)->links, "equity" => json_decode($json)->equity, "json_params" => $json]);
                } catch (\Throwable $th) {
                    dump($th);
                }
            }
    
            DB::table("processes")->where("id", $currentProcessId)->update(["status" => "stopped", "stopped_at" => date("Y-m-d H:i:s")]);
            dd("end: " . $this->argument("number"));
        }
    }
}
