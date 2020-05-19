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
        $statisticStatus = DB::table("processes")->where("name", "statistic")->first()->status;
        $query = DB::table("domains")->whereNull("json_params");
        $itemsCount = $query->count();
        return view("statistic/index", compact("itemsCount", "statisticStatus"));
    }

    public function collect()
    {   
        DB::table("processes")->where("name", "statistic")->update(["status" => "runned"]);
        $processesCount = 12;

        for ($i = 0; $i < $processesCount; $i++) 
        {
            $command = "php " . base_path("artisan") . " command:grabparams $i &";
            $process = new Process($command);
            $process->setTimeout(0);
            $process->disableOutput();
            $process->start();

            // ждать 0.5 секунды
            usleep(0500000);
        }

        return back();
    }

    public function stopcollect()
    {
        $processesCount = 1;
        for ($i = 0; $i < $processesCount; $i++) 
        {
            $command = "php  " . base_path("artisan") . " command:searchandkill command:grabparams &";

            $process = new Process($command);
            $process->setTimeout(0);
            $process->disableOutput();
            $process->start();

            // ждать 0.5 секунды
            usleep(0500000);
        }

        DB::table("processes")->where("name", "statistic")->update(["status" => "stopped"]);
        return back();
    }
}   
