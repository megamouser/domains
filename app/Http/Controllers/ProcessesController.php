<?php

namespace App\Http\Controllers;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

use Illuminate\Http\Request;

class ProcessesController extends Controller
{
    public function index()
    {
        $command = "ps aux | grep command:grabparams";
        $process = new Process($command);
        $process->run();
        $processOutput = $process->getOutput();
        $runnedProcessesArray = array_diff(explode("\n", $processOutput), [""]);
        
        $clearProcesses = [];

        foreach ($runnedProcessesArray as $key => $value) 
        {
            $clearProcesses[] = (array_diff(explode(" ", $value), [""]));
        }

        dump($clearProcesses);
    }

    public function kill()
    {
        
    }
}
