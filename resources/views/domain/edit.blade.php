@extends('main')
@section('content')
@include('parts/navigation')

<br>

<div class="container-fluid">
    <div class="container">
        <h1>Редактировать домен</h1>
    </div>
</div>

<div>
    <form action="/domains/{{ $domain->id }}" method="POST" enctype="mutlipart/form-data">
        @method('PATCH')
        @csrf

        <div>
            <input type="text" name="name" value="{{ old('name') ?? $domain->name }}">
        </div>
        <br>
        <div>
            <button type="submit">save</button>
        </div>
    </form>

    <div>
        {{ $errors->first('name') }}
    </div>
</div>
@endsection