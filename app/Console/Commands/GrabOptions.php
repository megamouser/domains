<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;

class GrabOptions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:graboptions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Transfer all json params from options to domains';

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

        $options = DB::table("options")->get();

        foreach ($options as $key => $option) 
        {
            try 
            {
                $optionDomainName = $option->domain_name;
                $jsonParams = json_decode($option->json_params);

                if($jsonParams) 
                {
                    $optionDomainDa = $jsonParams->da;
                    $optionDomainPa = $jsonParams->pa;
                    $optionDomainMozrank = $jsonParams->mozrank;
                    $optionDomainLinks = $jsonParams->links;
                    $optionDomainEquity = $jsonParams->equity;
                    $optionDomainJsonParams = $option->json_params;
                    $domain = DB::table("domains")->updateOrInsert(["name" => $optionDomainName, "da" => $optionDomainDa, "pa" => $optionDomainPa, "mozrank" => $optionDomainMozrank, "links" => $optionDomainLinks, "equity" => $optionDomainEquity, "json_params" => $optionDomainJsonParams]);
                }
            } 
            catch (\Illuminate\Database\QueryException $e) 
            {
                dump($option->domain_name);
            } 
            catch (ErrorException $e) {
                dump($option->domain_name);
            }
        }
    }
}
