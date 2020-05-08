<?php

namespace App\Http\Controllers;

use App\Domain;
use App\Option;
use App\Jobs\GetOption;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use DB;
use Artisan;
use GuzzleHttp\Client;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use function GuzzleHttp\json_decode;

class DomainController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function test()
    {
        $process = new Process(['ls', '-lsa']);
        $process->start();

        // ... do other things
        // waits until the given anonymous function returns true
        $process->waitUntil(function ($type, $output) {
            return $output === 'Ready. Waiting for commands...';
        });

        dd($process);

        // ... do things after the process is ready
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $search = "";
        $count = 50;
        $queryParams = collect(request()->query());
        $sort = "";

        if($queryParams->has("count"))
        {
            $count = $queryParams->get("count");
            if($count == null) 
            {
                $count = 50;
            }
        }

        $domains = DB::table("domains")->paginate($count)->appends($queryParams->toArray());

        if($queryParams->has("search"))
        {
            $search = $queryParams->get("search");
            $domains = DB::table("domains")->where("name", "LIKE", "%{$search}%")->paginate($count)->appends($queryParams->toArray());
        }

        if($queryParams->has("sort"))
        {
            $sort = $queryParams->get("sort");

            if($sort == "id" || $sort == "name" || $sort == "da" || $sort == "pa" || $sort == "moz" || $sort == "links" || $sort == "equity") 
            {
                $domains = DB::table("domains")->where("name", "LIKE", "%{$search}%")->orderBy($sort)->paginate($count)->appends($queryParams->toArray());
            } elseif($sort == "-id" || $sort == "-name" || $sort == "-da" || $sort == "-pa" || $sort == "-moz" || $sort == "-links" || $sort == "-equity") {
                $sorting = ltrim($sort, "-");
                $domains = DB::table("domains")->where("name", "LIKE", "%{$search}%")->orderBy($sorting, "DESC")->paginate($count)->appends($queryParams->toArray());
            }
        }

        return view("domain/index", compact("domains", "search", "count", "sort"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('domain/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request = request()->validate([
            'name' => 'required|min:3|unique:domains',
        ]);

        $domain = new Domain;
        $domain->name = $request["name"];
        $domain->save();

        return redirect("/domains");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Domain  $domain
     * @return \Illuminate\Http\Response
     */
    public function show(Domain $domain)
    {   
        return view('domain/show', compact('domain'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Domain  $domain
     * @return \Illuminate\Http\Response
     */
    public function edit(Domain $domain)
    {
        return view('domain/edit', compact('domain'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Domain  $domain
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Domain $domain)
    {   
        $domain->update($this->validateRequest());
        return redirect('/domains/' . $domain->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Domain  $domain
     * @return \Illuminate\Http\Response
     */
    public function destroy(Domain $domain)
    {
        $domain->delete();
        return redirect('domains');
    }

    public function getparams(Domain $domain)
    {
        dump($domain->name);

        if($domain->json_params == null) 
        {
            dump("Json params not found");
            dump("Statistic will be loaded from seo-rank");

            $client = new Client();

            $response = $client->request('GET', 'https://seo-rank.my-addr.com/api2/moz+alexa+sr+fb/1BAFA8ED4032A9DAFE1DEB9D0BD6AE6F/' . $domain->name);
            $json = json_encode(json_decode($response->getBody()));

            // $json = <<<EOT
            // {"da":0,"pa":1,"moz":0.1,"links":0,"equity":0,"a_rank":"unknown","a_links":"unknown","a_cnt":"unknown","a_cnt_r":"unknown","sr_domain":"notfound","sr_rank":"notfound","sr_kwords":"notfound","sr_traffic":"notfound","sr_costs":"notfound","sr_ulinks":"0","sr_hlinks":"0","sr_dlinks":"0","fb_comments":0,"fb_shares":0,"fb_reac":0}
            // EOT;

            $domain->json_params = $json;
            $domain->da = json_decode($json)->da;
            $domain->pa = json_decode($json)->pa;
            $domain->moz = json_decode($json)->mozrank;
            $domain->links = json_decode($json)->links;
            $domain->equity = json_decode($json)->equity;
            $domain->update();
            return back();
        }
    }

    public function import() 
    { 
        $runnedExportProcess = DB::table("processes")->where("name", "=", "import")->where("status", "=", "runned")->get();
        $importAllowed = true;

        if($runnedExportProcess->count())
        {
            $importAllowed = false;
        }

        return view('domain/import/index', compact('importAllowed'));
    }

    public function export()
    {  
        $runnedExportProcess = DB::table("processes")->where("name", "=", "export")->where("status", "=", "runned")->get();
        $exportAllowed = true;

        if($runnedExportProcess->count())
        {
            $exportAllowed = false;
        }

        $domainsCount = DB::table("domains")->count();
        return view('domain/export/index', compact('domainsCount', 'exportAllowed'));
    }

    public function importSettings(Request $request)
    {
        $validatedRequest = $request->validate([
            "xlsx" => "required|mimes:xlsx"
        ]);
        
        $fileRealPath = $validatedRequest["xlsx"]->getRealPath();
            
        $command = "command:exceltodomains $fileRealPath &";
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

        return redirect("/domains/import");
    }

    public function exportSettings()
    {
        $startEndParam = request()->startend;

        $params = explode("-", request()->startend);
        $startNum = $params[0];
        $endNum = $params[1];
        
        $command = "command:domainstoexcel $startNum $endNum &";
        
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

    private function validateRequest()
    {
        return request()->validate([
            'name' => 'required|min:3',
        ]);
    }
}
