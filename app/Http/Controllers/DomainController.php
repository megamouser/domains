<?php

namespace App\Http\Controllers;

use App\Domain;
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
        $domains = Domain::paginate(15);
        return view('domain/index', compact('domains'));
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
        $domains = DB::table('domains')->where('name', 'like', '%' . $search . '%')->paginate(15);
        return view('domain/index', compact('domains'));
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
