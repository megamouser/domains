<?php

namespace App\Http\Controllers;

use App\Domain;
use \App\Option;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use DB;
use GuzzleHttp\Client;

use function GuzzleHttp\json_decode;

class DomainController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');~
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $domains = null;
        $search = "";
        $domains = DB::table("domains");

        $queryParams = collect(request()->query());

        if($queryParams->has("search"))
        {
            $search = $queryParams->get("search");
            $domains = $domains->where("name", "LIKE", "%{$search}%");
        }

        if($queryParams->has("sort"))
        {
            $sort = $queryParams->get("sort");
            $domains = $domains->orderBy($sort, "asc");
        }

        $domains = $domains->paginate(10)->appends(request()->query());
        return view("domain/index", compact("domains", "search"));
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
        Domain::create($this->validateRequest());
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
        dd($domain->getAttributes());
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

    public function import() 
    {
        return view('domain/import/index');
    }

    public function settings(Request $request)
    {
        $request->validate([
            "csv" => "required|mimes:csv,txt"
        ]);
        
        $csv_file = file($request->csv->getRealPath());
        $parts = $this->csvStringsToArray($csv_file, 20000, false);
        foreach ($parts as $key => $strings) 
        {
            foreach($strings as $key => $string) 
            {
                $arr_data = str_getcsv($string);
                $str_domain_name = $arr_data[0];
                $domain = new Domain;
                $domain->name = $str_domain_name;
                $domain->save();
            }
        }
    }

    public function getOptions($id)
    {
        ini_set("memory_limit", "2000M");
        set_time_limit(10000);

        $domains = DB::table("domains")->where("name", "LIKE", "%.ru%")->get();
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
        // dd("test");
        dd($domainNamesWithoutOptions);
        $domains = $domainNamesWithoutOptions->chunk(200)[$id];
        
        foreach ($domains as $key => $value) 
        {
            $option = new Option;
            $option->domain_id = hexdec(uniqid());
            $option->domain_name = $value;
            $option->resource_name = "seo_rank_api2";
    
            $client = new Client();
            $response = $client->request('GET', 'https://seo-rank.my-addr.com/api2/moz+alexa+sr+fb/1BAFA8ED4032A9DAFE1DEB9D0BD6AE6F/' . $option->domain_name);
            $jsonParams = json_encode(json_decode($response->getBody()));
            $option->json_params = $jsonParams;
            $option->save();
        }
    }

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

    private function validateRequest()
    {
        return request()->validate([
            'name' => 'required|min:3',
        ]);
    }

    private function csvStringsToArray($csv_file, $rows_in_complect = 1000, $first_row_as_params = true) 
    {
        if($first_row_as_params) 
        {
            $data = array_slice($csv_file, 1);
            $result = (array_chunk($data, $rows_in_complect));
        } 
        else 
        {
            $data = array_slice($csv_file, 0);        
            $result = (array_chunk($data, $rows_in_complect));
        }

        return $result;
    }
}
