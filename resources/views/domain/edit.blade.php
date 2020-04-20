@extends('main')
@section('content')
@include('parts/navigation')

<br>

<div class="container-fluid">
    <div class="container">
        <h1>Edit a domain name</h1>
    </div>
</div>

<div class="container-fluid">
    <div class="container">
        <form class="form-inline my-2 my-lg-0" action="/domains/{{ $domain->id }}" method="POST" enctype="mutlipart/form-data">
            @method('PATCH')
            @csrf

            <input class="form-control mr-sm-2" type="text" name="name" value="{{ old('name') ?? $domain->name }}">
            <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Save</button>
        </form>
    </div>

    <div>
        {{ $errors->first('name') }}
    </div>
</div>
@endsection