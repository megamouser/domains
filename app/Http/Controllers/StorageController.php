<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;

use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class StorageController extends Controller
{
    public function index()
    {
        $domainsCount = DB::table("domains")->count();
        $domainsWithoutStatisticCount = DB::table("domains")->whereNull("json_params")->count();
        $domainsInStorageCount = DB::table("domains_storage")->count();
        $domainsInStorageWithoutStatisticCount = DB::table("domains_storage")->whereNull("json_params")->count();
        return view("storage/index", compact("domainsCount", "domainsWithoutStatisticCount", "domainsInStorageCount", "domainsInStorageWithoutStatisticCount"));
    }

    public function store()
    {
        $command = "command:domainstostorage";
        $numberOfProcesses = 1;

        for ($i = 0; $i < $numberOfProcesses; $i++) 
        {
            $process = new Process('php ' . base_path('artisan') . " $command &");
            $process->setTimeout(0);
            $process->disableOutput();
            $process->start();
            $processes[] = $process;
        }

        while(count($processes))
        {
            foreach ($processes as $key => $runningProcess) 
            {
                if(!$runningProcess->isRunning())
                {
                    unset($processes[$key]);
                }

                sleep(1);
            }
        }

        return back();
    }
    
    public function extract()
    {
        $domainsCount = request()->domainsCount;
        $command = "command:extractdomains $domainsCount &";

        $numberOfProcesses = 1;

        for ($i = 0; $i < $numberOfProcesses; $i++) 
        {
            $process = new Process('php ' . base_path('artisan') . " $command");
            $process->setTimeout(0);
            $process->disableOutput();
            $process->start();

            $processes[] = $process;
        }

        while(count($processes))
        {
            foreach ($processes as $key => $runningProcess) 
            {
                if(!$runningProcess->isRunning())
                {
                    unset($processes[$key]);
                }

                sleep(1);
            }
        }

        return back();
    }

    public function extractwithoutparams()
    {
        $domainsCount = request()->domainsCount;
        $command = "command:extractdomains $domainsCount --params &";

        $numberOfProcesses = 1;

        for ($i = 0; $i < $numberOfProcesses; $i++) 
        {
            $process = new Process('php ' . base_path('artisan') . " $command");
            $process->setTimeout(0);
            $process->disableOutput();
            $process->start();

            $processes[] = $process;
        }

        while(count($processes))
        {
            foreach ($processes as $key => $runningProcess) 
            {
                if(!$runningProcess->isRunning())
                {
                    unset($processes[$key]);
                }

                sleep(1);
            }
        }

        return back();
    }
}
