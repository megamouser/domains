@extends('main')
@section('content')
@include('parts/navigation')

<br>

<div class="container-fluid">
    <div class="container">
        <h1>Settings</h1>
    </div>
</div>

<div class="container-fluid">
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2>Files</h2>
            </div>
            <div class="card-body">
                @if ($files)
                    @foreach ($files as $file)
                        <div>
                            <span class="mr-2">{{ $file }}</span> | <a href="/settings/download?filename={{ $file }}">Download</a> | <a href="/settings/delete?filename={{ $file }}">Delete</a>  
                        </div>
                    @endforeach
                @else
                    <div>
                        Files not found
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<br>

{{-- 
<div class="container-fluid">
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2>Processes</h2>
            </div>
            <div class="card-body">
                @if ($files)
                    @foreach ($files as $file)
                        <div>
                            <span href="">{{ $file }}</span> |
                            <a href="">Download</a> |
                            <a href="">Delete</a>
                        </div>
                    @endforeach
                @else
                    <div>
                        Files not found
                    </div>
                @endif
            </div>
        </div>
    </div>
</div> --}}

<br>

{{-- 
<div class="container-fluid">
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2>Notifications</h2>
            </div>
            <div class="card-body">
                @if ($files)
                    @foreach ($files as $file)
                        <div>
                            <span href="">{{ $file }}</span> |
                            <a href="">Download</a> |
                            <a href="">Delete</a>
                        </div>
                    @endforeach
                @else
                    <div>
                        Files not found
                    </div>
                @endif
            </div>
        </div>
    </div>
</div> 
--}}
@endsection