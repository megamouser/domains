<?php

namespace App\Console\Commands;
use Illuminate\Console\Command;
use DB;

class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $currentProcessId = DB::table("processes")->insertGetId(["name" => "test", "status" => "runned", "runned_at" => date("Y-m-d H:i:s")]);
        sleep(10);
        DB::table("processes")->where("id", $currentProcessId)->update(["status" => "stopped", "stopped_at" => date("Y-m-d H:i:s")]);
        dd("end");
    }
}
