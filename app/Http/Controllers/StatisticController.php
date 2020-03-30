<?php

namespace App\Http\Controllers;

use App\Statistic;
use Illuminate\Http\Request;
use DB;
use App\Domain;
use App\Option;

class StatisticController extends Controller
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
        set_time_limit(10000);
        $data = DB::table("domains")->count();
        dd($data);

        // foreach ($data[18] as $key => $data_value) 
        // {
        //     $option = new Option;
        //     $option->domain_name = $data_value->domain_name;
        //     $option->domain_id = $data_value->domain_id;
        //     $option->resource_name = $data_value->resource_name;
        //     $option->json_params = $data_value->json_params;
        //     $option->save();
        // }
        // foreach ($domainsOldRows as $key => $domainOldRow)
        // {
        //     $domain = Domain::where("name", "=", $domainOldRow->name);

        //     if($domain->exists())
        //     {
        //         dd($domain->get());
        //     }
        // }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Statistic  $statistic
     * @return \Illuminate\Http\Response
     */
    public function show(Statistic $statistic)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Statistic  $statistic
     * @return \Illuminate\Http\Response
     */
    public function edit(Statistic $statistic)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Statistic  $statistic
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Statistic $statistic)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Statistic  $statistic
     * @return \Illuminate\Http\Response
     */
    public function destroy(Statistic $statistic)
    {
        //
    }
}
