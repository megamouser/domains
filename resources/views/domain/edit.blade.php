@extends('main')
@section('content')
<div>
    @include('parts/navigation')
</div>
<div>
    Domains / Edit
</div>
<br>
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