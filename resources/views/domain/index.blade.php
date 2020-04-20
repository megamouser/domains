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
    @if(count($domains))

        <div class="container">
            <form class="form-inline my-2" action="/domains" method="get">
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
                    {{-- <input class="form-control" aria-label="order" name="order" type="text" value="{{ $sort }}" placeholder="Поиск"> --}}
                </div>
                <button class="btn btn-outline-primary m-1" type="submit">Search</button>
            </form>
        </div>

        <div class="container">
            <div class="table-responsive">
                <div>
                    <table class="table table-bordered table-striped rounded">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">NAME</th>
                                <th scope="col">DA</th>
                                <th scope="col">PA</th>
                                <th scope="col">MOZ</th>
                                <th scope="col">LINKS</th>
                                <th scope="col">EQUITY</th>
                            </tr>
                        </thead>
    
                        <tbody>
                            @foreach($domains as $domain)
                                <tr>
                                    <th scope="row">{{ $domain->id }}</th>
                                    <td><a href="/domains/{{ $domain->id }}">{{ $domain->name }}</a></td>
                                    <td>{{ $domain->da }}</td>
                                    <td>{{ $domain->pa }}</td>
                                    <td>{{ $domain->mozrank }}</td>
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

            {{-- 
                <div class="col text-right">
                    <form action="/domains">
                        <input type="hidden" name="search" value="{{ $search }}">
                        <input class="form-control" type="number" name="count" value="{{ $count }}">
                    </form>
                </div> 
            --}}
                
        </div>

    @else
        <div class="container">
            <form class="form-inline my-2" action="/domains" method="get">
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
                <div class="input-group m-1">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Sort</span>
                    </div>
                    <input class="form-control" aria-label="order" name="sort" type="text" value="{{ $sort }}" placeholder="Поиск">
                </div>

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


<div class="container-fluid">
    <div class="container">
        <a href="domains/create">Create a domain</a>
    </div>
    <div class="container">
        <a href="/domains?search=.ru">Only RU</a>
    </div>
    <div class="container">
        <a href="/domains?search=.com">Only COM</a>
    </div>
    <div class="container">
        <a href="/domains/export">Export</a>
    </div>
    <div class="container">
        <a href="/domains/import">Import</a>
    </div>
</div>
@endsection