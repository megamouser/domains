<?php

namespace App\Console\Commands;
use Illuminate\Console\Command;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class SearchAndKill extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:searchandkill {search}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'search processes and kill by their pids';

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
        // Searching processes 
        $search = $this->argument("search");
        $command = "ps aux | grep $search";

        $process = new Process($command);
        $process->run();
        $processOutput = $process->getOutput();
        $runnedProcessesArray = array_diff(explode("\n", $processOutput), [""]);
        
        $arrProcessesInfo = [];

        foreach ($runnedProcessesArray as $key => $value) 
        {
            $arrProcessesInfo[] = (array_diff(explode(" ", $value), [""]));
        }

        $pids = [];
        $arrProcessesInfo = array_map('array_values', $arrProcessesInfo);
        
        foreach ($arrProcessesInfo as $key => $value) 
        {
            $pids[] = $value[1];
        }

        $pidsString = "";
        foreach ($pids as $key => $pid) 
        {
            $pidsString .= $pid .= " ";
        }

        $command = "kill -9 $pidsString&";
        $process = new Process($command);
        $process->run();
        dd($command);
    }
}
