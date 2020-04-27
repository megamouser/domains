@extends('main')
@section('content')
@include('parts/navigation')

<br>

<div class="container-fluid">
    <div class="container">
        <h1>Collect statistics</h1>
    </div>

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
</div>
@endsection