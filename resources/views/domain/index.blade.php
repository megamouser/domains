@extends('main')
@section('content')
<div>
    @include('parts/navigation')
</div>
<div>
    Domains
</div>

<br>

<div>
    <form action="/domains/search" method="get">
        <div>
            <input name="search" type="search" value="{{ $search }}" placeholder="searching domain name">
        </div>

        <br>

        <div>
            <button type="submit">search</button>
        </div>

    </form>
</div>

<br>

<div>
    <ul>
        @foreach($domains as $domain)
            <div class="domain">
                <a href="/domains/{{ $domain->id }}">
                    <div>                    
                        <input class="checkbox" data-name="{{ $domain->name }}" type="checkbox">
                        <span>{{ $domain->name }}</span>
                    </div>
                </a>
            </div>
        @endforeach
    </ul>
</div>
<br>
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