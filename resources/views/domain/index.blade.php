@extends('main')
@section('content')
<div class="container">
    @include('parts/navigation')
</div>

<div class="container">
    Domains search
</div>

<div class="container">
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
<div class="container">
    <table class="table table-bordered table-dark">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Statistics</th>
            </tr>
        </thead>
        <tbody>
            <form method="post" action="/options">
                @csrf
                <input type="submit">
            </form>
            @foreach($domains as $domain)
                <tr>
                    <th scope="row">{{ $domain->id }}</th>
                    <td><a href="/domains/{{ $domain->id }}">{{ $domain->name }}</a></td>
                    <td>
                        @if($domain->options()->get()->isNotEmpty())
                            <div data-domain="{{ $domain->name }}" style="color: green; font-weight: bolder;">
                                Success
                            </div>
                        @else
                            <div class="row">
                                <div class="col" style="color: red; font-weight: bolder;">
                                    Statistic data is not found
                                </div>  
                                <div data-domain="{{ $domain->name }}" style="cursor: pointer" class="col update_statistic">
                                    Get statistic data
                                </div>
                            </div>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="container">
    {{ $domains->links() }}
</div>

<div class="container">
    <a href="domains/create">create</a>
</div>

<div class="container">
    <a href="domains/import">import</a>
</div>
@endsection