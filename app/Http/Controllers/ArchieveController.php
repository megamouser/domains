<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;

class ArchieveController extends Controller
{
    public function index() 
    {
        $search = "";
        $count = 50;
        $queryParams = collect(request()->query());
        $sort = "";

        dump(request()->query());

        if($queryParams->has("count"))
        {
            $count = $queryParams->get("count");
            if($count == null) 
            {
                $count = 50;
            }
        }

        $domains = DB::table("domains_archieve")->paginate($count)->appends($queryParams->toArray());

        if($queryParams->has("search"))
        {
            $search = $queryParams->get("search");
            $domains = DB::table("domains_archieve")->where("name", "LIKE", "%{$search}%")->paginate($count)->appends($queryParams->toArray());
        }

        if($queryParams->has("sort"))
        {
            $sort = $queryParams->get("sort");

            if($sort == "id" || $sort == "name" || $sort == "da" || $sort == "pa" || $sort == "moz" || $sort == "links" || $sort == "equity") 
            {
                $domains = DB::table("domains_archieve")->where("name", "LIKE", "%{$search}%")->orderBy($sort)->paginate($count)->appends($queryParams->toArray());
            } elseif($sort == "-id" || $sort == "-name" || $sort == "-da" || $sort == "-pa" || $sort == "-moz" || $sort == "-links" || $sort == "-equity") {
                $sorting = ltrim($sort, "-");
                $domains = DB::table("domains_archieve")->where("name", "LIKE", "%{$search}%")->orderBy($sorting, "DESC")->paginate($count)->appends($queryParams->toArray());
            }
        }

        return view("archieve/index", compact("domains", "search", "count", "sort"));
    }
}
