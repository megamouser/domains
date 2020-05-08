@extends('main')
@section('content')
@include('parts/navigation')

<br>

<div class="container-fluid">
    <div class="container">
        <div class="card">

            <div class="card-header">
                <h1>Domains Archieve</h1>
            </div>

            <div class="card-body pb-0">
                <ul class="list-group">
                    <li class="list-group-item">
                        <div>
                            <span>Domains count:</span>

                            <span class="badge badge-pill badge-info p-2">
                                {{ $domainsCount }}
                            </span>
                        </div>

                        @if($domainsCount > 0)
                            <form action="/archieve/store" method="GET">
                                <button class="btn btn-success" type="submit">
                                    Store  
                                </button>
                            </form>
                        @endif
                    </li>

                    <li class="list-group-item">
                        <span>Domains without statistic count:</span>
        
                        <span class="badge badge-pill badge-info p-2">
                            {{ $domainsWithoutStatisticCount }}
                        </span>
                    </li>
                    
                    <li class="list-group-item">
                        <span>Domains in storage:</span>

                        <span class="badge badge-pill badge-info p-2">
                            {{ $domainsInStorageCount }}
                        </span>

                        <div>
                            <a class="modalOneAction" href="#">Extract</a>
                        </div>
                    </li>

                    <li class="list-group-item">
                        <span>Domains without statistic params in storage:</span>
                        
                        <span class="badge badge-pill badge-info p-2">
                            {{ $domainsInStorageWithoutStatisticCount }}
                        </span>

                        <div>
                            <a class="modalTwoAction" href="#">Extract</a>
                        </div>
                    </li>
                </ul>
            </div>

            <br>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="container p-2">
    </div>
</div>
@endsection