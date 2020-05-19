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
                @if($storageStatus == "runned")
                    <div class="alert alert-primary">
                        Processing runned... <br>
                        Please wait while storage will be done. <br>
                        You can reload this page to check results.
                    </div>
                @endif

                <ul class="list-group">
                    <li class="list-group-item">
                        <div>
                            <span>Domains count:</span>

                            <span class="badge badge-pill badge-info p-2">
                                {{ $domainsCount }}
                            </span>
                        </div>

                        @if($storageStatus == "stopped")
                            @if($domainsCount > 0)
                                <form action="/archieve/store" method="GET">
                                    <button class="btn btn-success" type="submit">
                                        Store  
                                    </button>
                                </form>
                            @endif
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

                        @if($storageStatus == "stopped")
                            <div>
                                <a class="modalOneAction" href="#">Extract</a>
                            </div>
                        @endif
                    </li>

                    <li class="list-group-item">
                        <span>Domains without statistic params in storage:</span>
                        
                        <span class="badge badge-pill badge-info p-2">
                            {{ $domainsInStorageWithoutStatisticCount }}
                        </span>

                        @if($storageStatus == "stopped")
                            <div>
                                <a class="modalTwoAction" href="#">Extract</a>
                            </div>
                        @endif
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