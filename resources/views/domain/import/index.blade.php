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
    <!-- Тип кодирования данных, enctype, ДОЛЖЕН БЫТЬ указан ИМЕННО так -->
    <form enctype="multipart/form-data" action="/domains/importing" method="POST">
        @csrf
        <input name="userfile" type="file">
        <br>
        <input type="submit" value="save">
    </form>

    <div>{{ $errors->first('file') }}</div>
</div>
@endsection