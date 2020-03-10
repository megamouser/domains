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
        <form class="form-inline my-2 my-lg-0" action="/domains/search" method="get">
            <input class="form-control mr-sm-2" aria-label="search" name="search" type="search" value="{{ $search }}" placeholder="searching domain name">
            <button class="btn btn-outline-dark my-2 my-sm-0" type="submit">search</button>
        </form>
    </div>
</div>

<br>

<div class="container">
    <table class="table table-dark table-striped rounded">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">DA</th>
                <th scope="col">PA</th>
                <th scope="col">MOZ</th>
            </tr>
        </thead>
        <tbody>
            @foreach($options as $option)
                <tr>
                    <th scope="row">{{ $option->id }}</th>
                    <td><a href="/domains/{{ $option->id }}">{{ $option->domain_name }}</a></td>
                    <td>{{ json_decode($option->json_params)->da }}</td>
                    <td>{{ json_decode($option->json_params)->pa }}</td>
                    <td>{{ json_decode($option->json_params)->mozrank }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="container-fluid">
    {{ $options->links() }}
</div>

<div class="container">
    <a href="domains/create">create</a>
</div>

<div class="container">
    <a href="domains/import">import</a>
</div>
@endsection