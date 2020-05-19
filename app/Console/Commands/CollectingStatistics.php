<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CollectingStatistics extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:collectingstatistics {processesCount}';

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
        $processesCount = $this->argument("processesCount");

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
    }
}
