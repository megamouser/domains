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

        <div class="container">
            @if ($collectingAllowed)
                <button class="btn btn-success get-statistic">Start collecting</button>
            @else
                <button disabled class="btn btn-success get-statistic">Collecting statistic ... </button>
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
                <span>Domains without statistic params not found</span>
            </div>
        </div>
    @endif
</div>
@endsection