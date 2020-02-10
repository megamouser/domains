@extends('main')
@section('content')
<div>
    @include('parts/navigation')
</div>
<div>
    Domains / {{ $domain->name }}
</div>
<div>
    id: {{ $domain->id }}
</div>
<div>
    name: {{ $domain->name }}
</div>
<div>
    <a href="/domains/{{ $domain->id }}/edit">edit</a>
</div>
<br>
<div>
    <form action="/domains/{{ $domain->id }}" method="POST">
        @method("DELETE")
        @csrf

        <button type="submit">delete</button>
    </form> 

    <br><hr>

    <div>
        Statistics Options
    </div>

    Not Found

    <br>
    
    <form action="" method="">
        @csrf

        <button type="submit">update statistics</button>
    </form> 
</div>
@endsection