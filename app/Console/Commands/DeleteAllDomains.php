<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;

class DeleteAllDomains extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:deldomains';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete all domains';

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
        set_time_limit(120);

        $domains = DB::table("domains")->get();
        
        foreach ($domains as $key => $domain) 
        {
            dump($domain);
        }
    }
}
