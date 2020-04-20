@extends('main')
@section('content')
@include('parts/navigation')

<br>

<div class="container-fluid">
    <div class="container">
        <h1>Create a domain name</h1>
    </div>
</div>

<br>

<div class="container-fluid">
    <div class="container">
        <form class="form-inline my-2 my-lg-0" action="/domains" method="POST" enctype="mutlipart/form-data">
            @csrf

            <input class="form-control mr-sm-2" type="text" placeholder="Имя домена" name="name" value="{{ old('name') }}">
            <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Save</button>
        </form>

        <div class="container">
            <span style="color: red; font-weight: bolder;">{{ $errors->first('name') }}</span>
        </div>
    </div>
</div>
@endsection