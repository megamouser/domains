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

    public function test(Request $request)
    {
        return response()->json(['message' => 'My response from option controller'], 200);
    }

    public function testrequest()
    {
        $search = '.com';
        $domains = DB::table('domains')->where('name', 'like', '%' . $search . '%')->get();
        foreach ($domains as $key => $domain) 
        {
            $client = new Client();
            $response = $client->request('GET', 'https://seo-rank.my-addr.com/api2/moz+alexa+sr+fb/61AA6620697F14072F72AA47479EC328/' . $domain->name);
            $statisticOption = json_encode(json_decode($response->getBody()));
            
            $option = new Option;
            $option->domain_id = $domain->id;
            $option->name = "seo_rank_api2";
            $option->params = $statisticOption;
            dump($option);
            $option->save();
        }
    }
}
