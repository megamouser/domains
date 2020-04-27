<?php

namespace App\Http\Controllers;
use DB;

use Illuminate\Http\Request;

use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class StatisticController extends Controller
{
    public function index()
    {
        $query = DB::table("domains")->whereNull("json_params");
        $itemsCount = $query->count();

        $search = "collecting";
        $runnedCollectionProcess = DB::table("processes")->where("name", "LIKE", "%{$search}%")->where("status", "=", "runned")->get();
        $collectingAllowed = true;

        if($runnedCollectionProcess->count()) 
        {
            $collectingAllowed = false;
        }

        return view("statistic/index", compact("itemsCount", "collectingAllowed"));
    }

    public function collect()
    {   
        $processesCount = 10;
        for ($i = 0; $i < $processesCount; $i ++) {
            $command = "php " . base_path("artisan") . " command:grabparams $i &";
            $process = new Process($command);
            $process->setTimeout(0);
            $process->disableOutput();
            $process->start();
        }

        return back();
    }
}   
