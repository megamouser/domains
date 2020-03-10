<?php

namespace App\Http\Controllers;

use App\Domain;
use \App\Option;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use DB;

use function GuzzleHttp\json_decode;

class DomainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function index()
    {
        
        $domains = DB::table("domains")->get()->chunk(10)->get(0);
        // dd(DB::table("domains")->get()->chunk(10)->get(21197));
        // dd(DB::table("domains")->get()->chunk(10)->count());
        $search = '';
        return view('domain/index', compact('domains', 'search'));
    }

    public function getDomains()
    {
        $requestDataParams = request()->params;
        
        $searchString = null;
        $itemsInOnePage = null;
        $itemsPageNumber = null;
        $itemsCount = null;
        $items = null;

        if($requestDataParams["search"]) 
        {
            $searchString = $requestDataParams["search"];
            $itemsInOnePage = $requestDataParams["itemsInOnePage"];
            $itemsPageNumber = $requestDataParams["itemsPageNumber"];

            $mainRequest = DB::table("domains")->where("name", "LIKE", "%{$searchString}%")->get();
            $chunkedData = $mainRequest->chunk($itemsInOnePage);
            $itemsCount = $mainRequest->count();
            $pagesCount = $chunkedData->count();
            $items = $chunkedData->get($itemsPageNumber);

            return ["searchString" => $searchString, "itemsInOnePage" => $itemsInOnePage, "itemsPageNumber" => $itemsPageNumber, "itemsCount" => $itemsCount, "pagesCount" => $pagesCount, "items" => $items];
        }
        else 
        {
            $searchString = $requestDataParams["search"];
            $itemsInOnePage = $requestDataParams["itemsInOnePage"];
            $itemsPageNumber = $requestDataParams["itemsPageNumber"];

            $mainRequest = DB::table("domains")->get();
            $chunkedData = $mainRequest->chunk($itemsInOnePage);
            $itemsCount = $mainRequest->count();
            $pagesCount = $chunkedData->count();
            $items = $chunkedData->get($itemsPageNumber);

            return ["searchString" => $searchString, "itemsInOnePage" => $itemsInOnePage, "itemsPageNumber" => $itemsPageNumber, "itemsCount" => $itemsCount, "pagesCount" => $pagesCount, "items" => $items];
        }
        // $itemsOnPage = request()->itemsOnPage;
        // $pageNumber = request()->pageNumber;
        // // $singleDomain = DB::table("domains")->first();
        // // $domainKeys = [];
        
        // // foreach ($singleDomain as $key => $value) 
        // // {
        // //     $domainKeys[] = $key;
        // // }

        // $allDomains = DB::table("domains")->get();
        // $domainsChunkCount = $allDomains->chunk($itemsOnPage)->count();
        // $domainsChunk = $allDomains->chunk($itemsOnPage)->get($pageNumber)->values()->toArray();
        // $allDomainsCount = $allDomains->count();

        // return [
        //         "itemsChunk" => $domainsChunk, 
        //         "allItemsCount" => $allDomainsCount, 
        //         "itemsInChunk" => $itemsOnPage, 
        //         "chunkNumber" => $pageNumber, 
        //         "chunksCount" => $domainsChunkCount,
        //         // "domainKeys" => $domainKeys
        //     ];
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
        $optionCount = count($domain->options);

        if($optionCount) 
        {
            dump($domain->options);
            return view('domain/show', compact('domain'));

        } 
        else 
        {
            dump("Опции не обнаружены");
            return view('domain/show', compact('domain'));
        }
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
        return view('domain/import/index', compact('domains'));
    }

    public function settings(Request $request)
    {
        $request->validate([
            "csv" => "required|mimes:csv,txt"
        ]);
        
        $csv_file = file($request->csv->getRealPath());
        $parts = $this->csvStringsToArray($csv_file, 20000);
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

    public function listing()
    {
        $search = "";
        $options = DB::table("options")->where("domain_name", "LIKE", "%{$search}%")->paginate(1000)->appends(request()->query());
        // foreach ($options as $key => $option) 
        // {
        //     dd(json_decode($option->json_params)->mozrank);
        // }

        return view("domain/listing", compact("search", "options"));
    }

    public function search(Request $request)
    {
        $search = $request->get('search');
        $domains = Domain::query()->where("name", "LIKE", "%{$search}%")->paginate(1000)->appends(request()->query());
        return view('domain/index', compact('domains', 'search', 'domainsCount'));
    }

    public function getOptions($id)
    {   
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

        $domainsNamesWithoutOptions = $domainsNames->diff($optionsDomainNames);
        $domains = $domainsNamesWithoutOptions->chunk(50)[$id];
        foreach ($domains as $key => $domain) 
        {
            echo "<div data-domain='$domain' class='update_statistic'>" . $domain . "</div>";
        }

        return view("domain/getoptions");
    }

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
