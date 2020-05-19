<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ExportDomainsToExcel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:domainstoexcel {startNum} {endNum}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Export domain names into excel file';

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
        DB::table("processes")->where("name", "export")->update(["status" => "runned"]);

        if($this->argument("startNum") <= $this->argument("endNum"))
        {
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();

            $sheet->setCellValue('A1', 'id');
            $sheet->setCellValue('B1', 'name');
            $sheet->setCellValue('C1', 'da');
            $sheet->setCellValue('D1', 'pa');
            $sheet->setCellValue('E1', 'moz');
            $sheet->setCellValue('F1', 'links');
            $sheet->setCellValue('G1', 'equity');
            $sheet->setCellValue('H1', 'json_params');
            $sheet->setCellValue('I1', 'created_at');
            $sheet->setCellValue('J1', 'updated_at');

            $cellId = 2;
            $i = 0;
            $domains = DB::table("domains")->get();

            foreach ($domains as $key => $domain) 
            {
                if($i >= $this->argument("startNum") && $i <= $this->argument("endNum"))
                {
                    $sheet->setCellValue("A$cellId", $domain->id);
                    $sheet->setCellValue("B$cellId", $domain->name);
                    $sheet->setCellValue("C$cellId", $domain->da);
                    $sheet->setCellValue("D$cellId", $domain->pa);
                    $sheet->setCellValue("E$cellId", $domain->moz);
                    $sheet->setCellValue("F$cellId", $domain->links);
                    $sheet->setCellValue("G$cellId", $domain->equity);
                    $sheet->setCellValue("H$cellId", $domain->json_params);
                    $sheet->setCellValue("I$cellId", $domain->created_at);
                    $sheet->setCellValue("J$cellId", $domain->updated_at);
                    $cellId++;
                }

                $i++;
            }

            $writer = new Xlsx($spreadsheet);
            $documentName = $this->argument("startNum") . "-" . $this->argument("endNum");
            $writer->save(storage_path("app/public/exported/$documentName.xlsx"));
        }

        DB::table("processes")->where("name", "export")->update(["status" => "stopped"]);
    }
}
