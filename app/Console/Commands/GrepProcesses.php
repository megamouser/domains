<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class GrepProcesses extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:grepprocesses';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Output runned php processes like array';

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
        $command = "ps aux | grep php";
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
}
