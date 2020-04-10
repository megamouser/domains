<?php

namespace App\Http\Controllers;

use App\Domain;
use App\Option;
use App\Jobs\GetOption;
use App\Jobs\CreateDomainJob;
use App\Jobs\DeleteDomainJob;
use App\Jobs\ExportDomainsJob;
use App\Jobs\ImportDomainsJob;
use App\Jobs\PreparingDomainsJob;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use DB;
use GuzzleHttp\Client;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;


use function GuzzleHttp\json_decode;

class DomainController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
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
        $sort = "id";

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
            $domains = DB::table("domains")->where("name", "LIKE", "%{$search}%")->orderBy($sort)->paginate($count)->appends($queryParams->toArray());
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

        if($domain->json_params == null) {
            dump("Json params not found");
            dump("Statistic will be loaded from seo-rank");

            $client = new Client();

            $response = $client->request('GET', 'https://seo-rank.my-addr.com/api2/moz+alexa+sr+fb/1BAFA8ED4032A9DAFE1DEB9D0BD6AE6F/' . $domain->name);
            $json = json_encode(json_decode($response->getBody()));

            // $json = <<<EOT
            // {"da":0,"pa":1,"mozrank":0.1,"links":0,"equity":0,"a_rank":"unknown","a_links":"unknown","a_cnt":"unknown","a_cnt_r":"unknown","sr_domain":"notfound","sr_rank":"notfound","sr_kwords":"notfound","sr_traffic":"notfound","sr_costs":"notfound","sr_ulinks":"0","sr_hlinks":"0","sr_dlinks":"0","fb_comments":0,"fb_shares":0,"fb_reac":0}
            // EOT;

            $domain->json_params = $json;
            $domain->da = json_decode($json)->da;
            $domain->pa = json_decode($json)->pa;
            $domain->mozrank = json_decode($json)->mozrank;
            $domain->links = json_decode($json)->links;
            $domain->equity = json_decode($json)->equity;
            dd($domain->update());
        }
    }

    public function import() 
    {
        return view('domain/import/index');
    }

    public function export()
    {  
        $domainsCount = DB::table("domains")->count();
        return view('domain/export/index', compact('domainsCount'));
    }

    public function importSettings(Request $request)
    {
        $validatedRequest = $request->validate([
            "csv" => "required|mimes:csv,txt"
        ]);

        $stdData = ( (object) file($validatedRequest["csv"]));

        foreach ($stdData as $key => $value) 
        {
            $value = trim($value, "\n");
            DB::table("domains")->updateOrInsert(["name" => $value]);
        }

        return redirect("/domains");
    }

    // public function exportSettings()
    // {
    //     $exportDomainsJob = new ExportDomainsJob();
    //     dispatch($exportDomainsJob);
    //     return redirect("domains");
        
    //     $processesCount = 3;
    //     for($i = 0; $i < $processesCount; $i++)
    //     {
    //         dump($i);
    //     }

    //     for ($i = 0; $i < $numberOfProcess; $i++) {
    //         $process = new Process('php ' . base_path('artisan') . " task {$i}");
    //         $process->setTimeout(0);
    //         $process->disableOutput();
    //         $process->start();
    //         $processes[] = $process;
    //    }

        // dd("end");
        // $process = new Process(['ls', '-lsa']);
        // $process->setTimeout(0);
        // // $process->disableOutput();
        // $process->run();
        
        // // executes after the command finishes
        // if (!$process->isSuccessful()) {
        //     throw new ProcessFailedException($process);
        // }
        
        // dd($process->getOutput());
        // ini_set("memory_limit", "-1");
        // set_time_limit(10000);

        // $preparingDomainsJob = new PreparingDomainsJob();
        // dispatch($preparingDomainsJob);

        // ini_set("memory_limit", "2000M");
        // set_time_limit(10000);

        // if(file_exists(base_path() . "/domains.csv"))
        // {
        //     unlink(base_path() . "/domains.csv");
        // }
        
        // $domains = DB::table("domains")->get();
        // dd($domains);
        // $domainsChunks = $domains->get()->chunk(300000);

        // foreach ($domainsChunks as $key => $domainsChunk) 
        // {
        //     $job = new ExportDomainsJob($domainsChunk);
        //     $this->dispatch($job);
        // }
    // }

    // public function getOption()
    // {
    //     $getOptionJob = new GetOption("TEST");
    //     $getOptionJob->delay(20);
    //     $this->dispatch($getOptionJob);
    //     return redirect("domains");
    // }

    // public function getOptions($id)
    // {
    //     ini_set("memory_limit", "2000M");
    //     set_time_limit(10000);

    //     $domains = DB::table("domains")->where("name", "LIKE", "%.ru%")->get();
    //     $options = DB::table("options")->get();
    //     $domainsNames = collect([]);
    //     $optionsDomainNames = collect([]);

    //     foreach ($domains as $key => $domain) 
    //     {
    //         $domainsNames->push($domain->name);
    //     }

    //     foreach ($options as $key => $option)
    //     {
    //         $optionsDomainNames->push($option->domain_name);
    //     }

    //     $domainNamesWithoutOptions = $domainsNames->diff($optionsDomainNames);
    //     // dd("test");
    //     dd($domainNamesWithoutOptions);
    //     $domains = $domainNamesWithoutOptions->chunk(200)[$id];
        
    //     foreach ($domains as $key => $value) 
    //     {
    //         $option = new Option;
    //         $option->domain_id = hexdec(uniqid());
    //         $option->domain_name = $value;
    //         $option->resource_name = "seo_rank_api2";
    
    //         $client = new Client();
    //         $response = $client->request('GET', 'https://seo-rank.my-addr.com/api2/moz+alexa+sr+fb/1BAFA8ED4032A9DAFE1DEB9D0BD6AE6F/' . $option->domain_name);
    //         $jsonParams = json_encode(json_decode($response->getBody()));
    //         $option->json_params = $jsonParams;
    //         $option->save();
    //     }
    // }

    // public function getOptions($id)
    // {   
    //     $domains = DB::table("domains")->get();
    //     $options = DB::table("options")->get();
    //     $domainsNames = collect([]);
    //     $optionsDomainNames = collect([]);

    //     foreach ($domains as $key => $domain) 
    //     {
    //         $domainsNames->push($domain->name);
    //     }

    //     foreach ($options as $key => $option)
    //     {
    //         $optionsDomainNames->push($option->domain_name);
    //     }

    //     $domainsNamesWithoutOptions = $domainsNames->diff($optionsDomainNames);
    //     $domains = $domainsNamesWithoutOptions->chunk(50)[$id];
    //     foreach ($domains as $key => $domain) 
    //     {
    //         echo "<div data-domain='$domain' class='update_statistic'>" . $domain . "</div>";
    //     }

    //     return view("domain/getoptions");
    // }

    public function statistic()
    {
        ini_set("memory_limit", "-1");
        set_time_limit(10000);

        // $domains = DB::table("domains")->where("name", "LIKE", "%.com%")->get();
        $domains = DB::table("domains")->get();
        $options = DB::table("options")->get();

        $domainsNames = collect([]);
        $optionsDomainNames = collect([]);

        foreach ($domains as $key => $domain) 
        {
            $domainsNames->push($domain->name);
        }

        foreach ($options as $key => $option)
        {
            $optionsDomainNames->push($option->domain_name);
        }

        $domainNamesWithoutOptions = $domainsNames->diff($optionsDomainNames);
        dd($domainNamesWithoutOptions);
    }

    private function validateRequest()
    {
        return request()->validate([
            'name' => 'required|min:3',
        ]);
    }

    // private function csvStringsToArray($csv_file, $rows_in_complect = 1000, $first_row_as_params = true) 
    // {
    //     if($first_row_as_params) 
    //     {
    //         $data = array_slice($csv_file, 1);
    //         $result = (array_chunk($data, 1000));
    //     } 
    //     else 
    //     {
    //         $data = array_slice($csv_file, 0);        
    //         $result = (array_chunk($data, $rows_in_complect));
    //     }

    //     return $result;
    // }
}
