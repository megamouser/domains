@extends('main')
@section('content')
<div class="container-fluid bg-dark">
    <div class="container">
        @include('parts/navigation')
    </div>
</div>

<div class="container-fluid">
    <div class="container">
        <span style="color: white;">Domains search</span>
    </div>

    <div class="container">
        <div class="col-md-5">
            <input class="form-control m-2" aria-label="search" name="search" type="search" placeholder="Поиск домена по имени">
        </div>
        <div class="col-md-3">
            <input class="form-control m-2" aria-label="count" name="itemsCount" type="number" placeholder="Кол-во на одной странице">
        </div>
    </div>
</div>

    <!-- <div class="container">
        <div class="row">
            <form class="form-inline" action="/domains/getDomains" method="post">
                @csrf
                <input class="form-control m-2" aria-label="search" name="search" type="search" value="{{ $search }}" placeholder="search by domain name">
                <button class="btn btn-outline-dark m-2">search</button>
            </form>
        </div>
    </div>  -->

    <div class="container domainsTable">
    </div>
</div>

<br>


{{-- <div class="container">
    <table class="table table-dark table-striped rounded">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Created</th>
            </tr>
        </thead>
        <tbody>
            @foreach($domains as $domain)
                <tr>
                    <th scope="row">{{ $domain->id }}</th>
                    <td scope="row"><a href="/domains/{{ $domain->id }}">{{ $domain->name }}</a></td>
                    <td scope="row">{{ $domain->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div> --}}

{{-- <div class="container-fluid">
    {{ $domains->links() }}
</div> --}}

{{-- <div class="container">
    <a href="domains/create">create</a>
</div>

<div class="container">
    <a href="domains/import">import</a>
</div> --}}
@endsection