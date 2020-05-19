<?php

namespace App\Console\Commands;
use Illuminate\Console\Command;
use DB;

class DomainsToStorage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:domainstostorage';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove domains to storage';

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

        $domains = DB::table("domains")->get();
        
        foreach ($domains as $key => $domain) 
        {
            try 
            {
                $updatingDomain = DB::table("domains_storage")->where("name", $domain->name)->get();

                if(count($updatingDomain) > 0)
                {
                    DB::table("domains_storage")->where("name", $domain->name)->update(["da" => $domain->da, "pa" => $domain->pa, "moz" => $domain->moz, "links" => $domain->links, "equity" => $domain->equity, "json_params" => $domain->json_params, "created_at" => date("Y-m-d H:i:s"), "updated_at" => date("Y-m-d H:i:s")]);
                    DB::table("domains")->where("name", "=", $domain->name)->delete();
                } else {
                    DB::table("domains_storage")->updateOrInsert(["name" => $domain->name, "da" => $domain->da, "pa" => $domain->pa, "moz" => $domain->moz, "links" => $domain->links, "equity" => $domain->equity, "json_params" => $domain->json_params, "created_at" => date("Y-m-d H:i:s"), "updated_at" => date("Y-m-d H:i:s")]);
                    DB::table("domains")->where("name", "=", $domain->name)->delete();
                }
            } 
            catch (\Throwable $th) 
            {
                DB::table("domains")->where("name", "=", $domain->name)->delete();
            }
        }

        DB::table("processes")->where("name", "storage")->update(["status" => "stopped"]);
    }
}
