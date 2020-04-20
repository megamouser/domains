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
        if($this->argument("startNum") <= $this->argument("endNum"))
        {
            $currentProcessId = DB::table("processes")->insertGetId(["name" => "export", "status" => "runned", "runned_at" => date("Y-m-d H:i:s")]);
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();

            $sheet->setCellValue('A1', 'id');
            $sheet->setCellValue('B1', 'name');
            $sheet->setCellValue('C1', 'da');
            $sheet->setCellValue('D1', 'pa');
            $sheet->setCellValue('E1', 'mozrank');
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
                    $sheet->setCellValue("E$cellId", $domain->mozrank);
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
            
            DB::table("processes")->where("id", $currentProcessId)->update(["status" => "stopped", "stopped_at" => date("Y-m-d H:i:s")]);
        }


        // foreach ($domains as $key => $domain) 
        // {
        //     if($startNum < $endNum) 
        //     {   
        //         $startNum++;
        //     }
        // }

        // dd("end");


        // $domains = DB::table("domains")->get();
        // $domainsInExport = 0;

        // $spreadsheet = new Spreadsheet();
        // $sheet = $spreadsheet->getActiveSheet();

        // $sheet->setCellValue('A1', 'id');
        // $sheet->setCellValue('B1', 'name');
        // $sheet->setCellValue('C1', 'da');
        // $sheet->setCellValue('D1', 'pa');
        // $sheet->setCellValue('E1', 'mozrank');
        // $sheet->setCellValue('F1', 'links');
        // $sheet->setCellValue('G1', 'equity');
        // $sheet->setCellValue('H1', 'json_params');
        // $sheet->setCellValue('I1', 'created_at');
        // $sheet->setCellValue('J1', 'updated_at');

        // foreach ($domains as $key => $domain) 
        // {
        //     $cellId = $key + 2;
        //     $domainsInExport++;

        //     $sheet->setCellValue("A$cellId", $domain->id);
        //     $sheet->setCellValue("B$cellId", $domain->name);
        //     $sheet->setCellValue("C$cellId", $domain->da);
        //     $sheet->setCellValue("D$cellId", $domain->pa);
        //     $sheet->setCellValue("E$cellId", $domain->mozrank);
        //     $sheet->setCellValue("F$cellId", $domain->links);
        //     $sheet->setCellValue("G$cellId", $domain->equity);
        //     $sheet->setCellValue("H$cellId", $domain->json_params);
        //     $sheet->setCellValue("I$cellId", $domain->created_at);
        //     $sheet->setCellValue("J$cellId", $domain->updated_at);

        //     if($domainsInExport == 200000)
        //     {
        //         break;
        //     }
        // }

        // $writer = new Xlsx($spreadsheet);
        // $writer->save(storage_path("app/public/exported/export.xlsx"));
        
        // DB::table("processes")->where("id", $currentProcessId)->update(["status" => "stopped", "stopped_at" => date("Y-m-d H:i:s")]);
        // dd("end");
    }
}
