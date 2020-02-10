@extends('main')
@section('content')
<div>
    @include('parts/navigation')
</div>
<div>
    Domains / Import
</div>
<br>
<div>
    <form enctype="multipart/form-data" action="/domains/import/settings" method="POST">
        @csrf
        
        <input name="csv" type="file">
        
        <br>
        
        <input type="submit" value="save">
    </form>

    <div>{{ $errors->first('csv') }}</div>
</div>
@endsection