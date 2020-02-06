@extends('main')
@section('content')
<div>
    @include('parts/navigation')
</div>
<div>
    Domains / Create
</div>
<br>
<div>
    <form action="/domains" method="POST" enctype="mutlipart/form-data">
        @csrf

        <div>
            <input type="text" placeholder="name" name="name" value="{{ old('name') }}">
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