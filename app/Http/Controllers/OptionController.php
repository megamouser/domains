<?php

namespace App\Http\Controllers;

use App\Domain;
use App\Option;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use DB;

class OptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $client = new Client;
        dd($client);
    }

    public function showAll()
    {
        $keyword = "da";
        $options = DB::table("options")->where("json_params", "like", "%null%")->get();
        dd($options);
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
        $domainNameFromRequest = $request->domainName;
        $domainAttributes = Domain::where("name", $domainNameFromRequest)->get()->first()->getAttributes();
        $option = new Option;
        $option->domain_id = $domainAttributes["id"];
        $option->domain_name = $domainAttributes["name"];
        $option->resource_name = "seo_rank_api2";

        $client = new Client();
        $response = $client->request('GET', 'https://seo-rank.my-addr.com/api2/moz+alexa+sr+fb/1BAFA8ED4032A9DAFE1DEB9D0BD6AE6F/' . $option->domain_name);
        $jsonParams = json_encode(json_decode($response->getBody()));
        $option->json_params = $jsonParams;
        $option->save();

        return $option->getAttributes();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function show(Option $option)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function edit(Option $option)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Option $option)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function destroy(Option $option)
    {
        //
    }
}
