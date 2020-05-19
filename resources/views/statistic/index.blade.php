@extends('main')
@section('content')
@include('parts/navigation')

<br>

<div class="container-fluid">
    <div class="container">
        <h1>Collect statistics</h1>
    </div>

    @if ($itemsCount)
        <div class="container">
            <span>Domain names without statistics: </span><span class="badge badge-pill badge-info p-2">{{ $itemsCount }}</span>
        </div>

        <br>

        <div class="container">
            @if($statisticStatus == "stopped")
                <button class="btn btn-success start-collecting">Start collecting</button>
                <button class="btn btn-danger stop-collecting">Stop collecting</button>
            @else
                @if($statisticStatus == "runned")
                    <div class="alert alert-primary">
                        Processing runned... <br>
                        Please wait while statistic will be done. <br>
                        You can reload this page to check results.
                    </div>
                @endif
                <button class="btn btn-success disabled">
                    <span>Collecting...</span>
                    <div class="spinner-border spinner-border-sm" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </button>
                <button class="btn btn-danger stop-collecting">Stop collecting</button>
            @endif
        </div>
    @else
        <div class="container">
            <span>Domain names without statistics:</span>
            <span class="badge badge-pill badge-info p-2">{{ $itemsCount }}</span>
        </div>

        <br>

        <div class="container">
            <div class="alert alert-warning">
                <h3>Warning!</h3>
                
                Domains without statistic params not found.
                <br>
                You can import domain names from xlsx file 
                <br>
                or load domain names from domains storage.
            </div>
        </div>
    @endif
</div>
@endsection