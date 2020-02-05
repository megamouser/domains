@extends('main')
@section('content')
<div>
    @include('parts/navigation')
</div>
<div>
    Domains
</div>
<div>
    <ul>
        @foreach($domains as $domain)
            <li>{{ $domain->id }}. <a href="domains/{{ $domain->id }}">{{ $domain->name }}</a></li>
        @endforeach
    </ul>
</div>
<div>
    <a href="domains/create">create</a>
</div>
<div>
    <a href="domains/import">import</a>
</div>
@endsection