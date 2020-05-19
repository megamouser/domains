<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use DB;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Box\Spout\Writer\Common\Creator\WriterEntityFactory;
use Box\Spout\Common\Entity\Row;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function settings()
    {
        $queryParams = collect(request()->query());
        $files = Storage::disk("public")->files("exported");
        return view("settings/index", compact("files"));
    }

    public function fileDownload()
    {
        $queryParams = collect(request()->query());
        $filename = $queryParams->get("filename");
        return response()->download(storage_path("app/public/" . $filename));
    }

    public function fileDelete(Request $request)
    {   
        $queryParams = collect(request()->query());
        $filename = $queryParams->get("filename");
        unlink(storage_path("app/public/" . $filename));
        return back();
    }
}
