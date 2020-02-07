@extends('main')
@section('content')
<div>
    @include('parts/navigation')
</div>
<div>
    Domains
</div>
<div>
    <form action="/domains/search" method="get">
        <div>
            <input name="search" type="search" placeholder="searching domain name">
        </div>
        <div>
            <button type="submit">search</button>
        </div>
    </form>
</div>
<div>
    <ul>
        @foreach($domains as $domain)
            <div>
                <a href="/domains/{{ $domain->id }}">{{ $domain->name }}</a>
            </div>
        @endforeach
    </ul>
</div>
<div>
    {{ $domains->links() }}
</div>
<div>
    <a href="domains/create">create</a>
</div>
<div>
    <a href="domains/import">import</a>
</div>
@endsection