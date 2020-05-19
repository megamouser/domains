@extends('main')
@section('content')
@include('parts/navigation')

<br>

<div class="container-fluid">
    <div class="container">
        <h1>Domains</h1>
    </div>
</div>

<div class="container-fluid">
    <div class="container">
        <div class="d-flex actions">
            <div class="p-2">
                <a href="domains/create">Create</a>
            </div>
            <div class="p-2">
                <a href="/domains/export">Export</a>
            </div>
            <div class="p-2">
                <a href="/domains/import">Import</a>
            </div>
        </div>
    </div>

    @if(count($domains))
        <div class="container">
            <form class="form-inline my-2 searchForm" action="/archieve" method="get">
                <div class="input-group m-1">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Name</span>
                    </div>
                    <input class="form-control" aria-label="search" name="search" type="search" value="{{ $search }}" placeholder="domain name">
                </div>
                <div class="input-group m-1">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Count</span>
                    </div>
                    
                    <input class="form-control" aria-lsabel="count" name="count" type="number" value="{{ $count }}" placeholder="Поиск">
                </div>

                <input type="hidden" name="sort" value={{ $sort }}>
                
                {{-- 
                    <div class="input-group m-1">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Sort</span>
                        </div>
                        <select id="mySelect" class="form-control" name="sort">
                            <option value="id">id</option>
                            <option value="name">name</option>
                            <option value="da">da</option>
                            <option value="pa">pa</option>
                            <option value="mozrank">mozrank</option>
                            <option value="links">links</option>
                            <option value="equity">equity</option>
                        </select>
                    </div> 
                --}}

                <button class="btn btn-outline-primary m-1" type="submit">Search</button>
            </form>
        </div>

        <div class="container">
            <div class="table-responsive">
                <div>
                    <table class="table table-bordered table-striped rounded">
                        <thead>
                            <tr>
                                <th scope="col">
                                    <a class="sort" href="#">ID</a>
                                </th>
                                <th scope="col">
                                    <a class="sort" href="#">NAME</a>
                                </th>
                                <th scope="col">
                                    <a class="sort" href="#">DA</a>
                                </th>
                                <th scope="col">
                                    <a class="sort" href="#">PA</a>
                                </th>
                                <th scope="col">
                                    <a class="sort" href="#">MOZ</a>
                                </th>
                                <th scope="col">
                                    <a class="sort" href="#">LINKS</a>
                                </th>
                                <th scope="col">
                                    <a class="sort" href="#">EQUITY</a>
                                </th>
                            </tr>
                        </thead>
    
                        <tbody>
                            @foreach($domains as $domain)
                                <tr>
                                    <th scope="row">{{ $domain->id }}</th>
                                    <td><a href="/domains/{{ $domain->id }}">{{ $domain->name }}</a></td>
                                    <td>{{ $domain->da }}</td>
                                    <td>{{ $domain->pa }}</td>
                                    <td>{{ $domain->moz }}</td>
                                    <td>{{ $domain->links }}</td>
                                    <td>{{ $domain->equity }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <div class="container">
            {{ $domains->links() }}
        </div>

    @else
        <div class="container">
            <form class="form-inline my-2 searchForm" action="/archieve" method="get">
                <div class="input-group m-1">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Name</span>
                    </div>

                    <input class="form-control" aria-label="search" name="search" type="search" value="{{ $search }}" placeholder="domain name">
                </div>
                <div class="input-group m-1">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Count</span>
                    </div>

                    <input class="form-control" aria-label="count" name="count" type="number" value="{{ $count }}" placeholder="Поиск">
                </div>

                <input type="hidden" name="sort" value="{{ $sort }}">

                <button class="btn btn-outline-primary m-1" type="submit">Search</button>
            </form>
        </div>

        <div class="container">
            <div class="table-responsive">
                <div>
                    <table class="table table-bordered table-striped rounded">
                        <tbody>
                            <tr>
                                <th style="text-align: center;">
                                    <div style="font-weight: bolder; color: #ccc">Список пуст</div>
                                </th>
                            </tr>
                        </tbody>
                    </table> 
                </div>       
            </div>
        </div> 
    @endif
</div>
@endsection