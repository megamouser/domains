@extends('main')
@section('content')
<div>
    @include('parts/navigation')
</div>
<div>
    Domains / Import / Settings
</div>
<br>
<div>
    <div>
        Import Settings
    </div>

    <div>
        Count Pats: {{ $count_parts }}
    </div>

    <div>
        Count Strings In Each Part: {{ $count_strings_in_part }}
    </div>

    <br>

    <div>
        Parts Importing Interface
    </div>

    <div>
        @foreach($parts as $key => $value)
            <div>Part Id: {{ $key }}</li>
            <div>Part Import Status: Fail</div>
            <br>
        @endforeach
    </div>

    <!-- <form enctype="multipart/form-data" action="/domains/importing" method="POST">
        @csrf
        <input name="csv" type="file">
        <br>
        <input type="submit" value="save">
    </form>

    <div>{{ $errors->first('csv') }}</div> -->
</div>
@endsection