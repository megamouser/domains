<?php

namespace App\Console\Commands;
use Illuminate\Console\Command;
use DB;

class ExtractDomains extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:extractdomains {count} {--params}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Extracting domains from storage';

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
        DB::table("processes")->where("name", "storage")->update(["status" => "runned"]);

        if($this->option("params"))
        {
            $domainsWithoutParamsFromStorage = DB::table("domains_storage")->whereNull("json_params")->get();
            $a = 0;

            foreach ($domainsWithoutParamsFromStorage as $key => $domain) 
            {
                try 
                {
                    if($a < $this->argument("count"))
                    {
                        DB::table("domains")->updateOrInsert(["name" => $domain->name, "da" => $domain->da, "pa" => $domain->pa, "moz" => $domain->moz, "links" => $domain->links, "equity" => $domain->equity, "json_params" => $domain->json_params, "created_at" => date("Y-m-d H:i:s"), "updated_at" => date("Y-m-d H:i:s")]);
                        $a++;
                    }
                    // DB::table("domains_storage")->where("name", "=", $domain->name)->delete();
                } 
                catch (\Throwable $th) 
                {
                    // DB::table("domains_storage")->where("name", "=", $domain->name)->delete();
                }   
            }
        } 
        else 
        {
            $domainsFromStorage = DB::table("domains_storage")->get();
            $a = 0;

            foreach ($domainsFromStorage as $key => $domain) 
            {
                try 
                {
                    if($a < $this->argument("count"))
                    {
                        DB::table("domains")->updateOrInsert(["name" => $domain->name, "da" => $domain->da, "pa" => $domain->pa, "moz" => $domain->moz, "links" => $domain->links, "equity" => $domain->equity, "json_params" => $domain->json_params, "created_at" => date("Y-m-d H:i:s"), "updated_at" => date("Y-m-d H:i:s")]);
                        $a++;
                    }
                    // DB::table("domains_storage")->where("name", "=", $domain->name)->delete();
                } 
                catch (\Throwable $th) 
                {
                    // DB::table("domains_storage")->where("name", "=", $domain->name)->delete();
                }   
            }
        }

        DB::table("processes")->where("name", "storage")->update(["status" => "stopped"]);
    }
}
