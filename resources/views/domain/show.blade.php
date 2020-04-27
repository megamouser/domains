@extends('main')
@section('content')
@include('parts/navigation')

<br>

<div class="container-fluid">
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h1>Information about a domain</h1>
            </div>
            <div class="card-body pb-0">
                <ul class="list-group">
                    <li class="list-group-item">
                        <b>id:</b> <span class="badge badge-info">{{ $domain->id }} </span>
                    </li>
                    <li class="list-group-item">
                        <b>name:</b> <span class="badge badge-info">{{ $domain->name }} </span>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                 <h4>Statistics</h4>

                @if ($domain->json_params)                    
                    <ul class="list-group">
                        <li class="list-group-item">
                            <b>da: </b> <span class="badge badge-success">{{ $domain->da }}</span>
                        </li>
                        <li class="list-group-item">
                            <b>pa: </b> <span class="badge badge-success">{{ $domain->pa }}</span>
                        </li>
                        <li class="list-group-item">
                            <b>mozrank: </b> <span class="badge badge-success">{{ $domain->moz }}</span>
                        </li>
                        <li class="list-group-item">
                            <b>links: </b> <span class="badge badge-success">{{ $domain->links }}</span>
                        </li>
                        <li class="list-group-item">
                            <b>equity: </b> <span class="badge badge-success">{{ $domain->equity }}</span>
                        </li>
                    </ul>
                @else
                    <ul class="list-group">
                        <li class="list-group-item">
                            Statistics not found: <a href="/domains/{{ $domain->id }}/getparams">get statistics for this domain name</a>
                        </li>
                    </ul>
                @endif
            </div>
            <div class="card-body">
                <h4>Actions</h4>
                <ul class="list-group">
                    <li class="list-group-item">
                        <div class="col">
                            <a href="/domains/{{ $domain->id }}/edit">Edit domain</a>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="col">
                            <form action="/domains/{{ $domain->id }}" method="POST">
                                @method("DELETE")
                                @csrf
                        
                                <button class="btn btn-outline-danger" type="submit">Delete domain</button>
                            </form> 
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection