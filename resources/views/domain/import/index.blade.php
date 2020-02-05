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
    <form action="/domains/importing" method="POST" enctype="mutlipart/form-data">
        @csrf
        
        <label for="file">csv file</label>
        <br>
        <input type="file" name="file" id="file">
        <br><br>
        <button type="submit">save</button>
    </form>

    <div>{{ $errors->first('file') }}</div>
</div>
@endsection