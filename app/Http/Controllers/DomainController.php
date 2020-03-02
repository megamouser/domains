<?php

namespace App\Http\Controllers;

use App\Domain;
use \App\Option;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use DB;


class DomainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $domain = Domain::first();
        $domains = Domain::paginate(15);
        $search = '';
        return view('domain/index', compact('domains', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        dump("Creating a new domain");
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
                $str_domainname = $arr_data[0];
                $domain = new Domain;
                $domain->name = $str_domainname;
                $domain->save();
            }
        }
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
        $domains = $domainsNamesWithoutOptions->chunk(300)[$id];
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
