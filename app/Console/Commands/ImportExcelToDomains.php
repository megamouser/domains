<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;

class ImportExcelToDomains extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:exceltodomains {file}';

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
        $currentProcessId = DB::table("processes")->insertGetId(["name" => "import", "status" => "runned", "runned_at" => date("Y-m-d H:i:s")]);
        $fileRealPath = $this->argument("file");
        $spreadSheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($fileRealPath);
        $workSheet = $spreadSheet->getActiveSheet();
        $highestRow = $workSheet->getHighestRow();
        $domains = [];

        for ($i = 0; $i <= $highestRow; $i++) 
        { 
            $domainName = $workSheet->getCell("A$i")->getValue();

            if($domainName !== null)
            {
                DB::table("domains")->updateOrInsert(["name" => $domainName]);
            }
        }

        DB::table("processes")->where("id", $currentProcessId)->update(["status" => "stopped", "stopped_at" => date("Y-m-d H:i:s")]);
    }
}
