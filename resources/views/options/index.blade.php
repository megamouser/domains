@extends('main')
@section('content')
<div class="container-fluid bg-dark">
    <div class="container">
        @include('parts/navigation')
    </div>
</div>

<br>

<div class="container">
    <table class="table table-bordered table-striped rounded">
        <thead>
            <tr>
                <th colspan="5">
                    <div class="container">
                        <form class="form-inline my-2 my-lg-0" action="/options" method="get">
                            <input class="form-control mr-sm-2" aria-label="search" name="search" type="search" value="{{ $search }}" placeholder="Полнотекстовый поиск">
                            <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">поиск</button>
                        </form>
                    </div>
                </th>
            </tr>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Имя домена</th>
                <th scope="col">DA</th>
                <th scope="col">PA</th>
                <th scope="col">MOZ</th>
            </tr>
        </thead>
        <tbody>
            @foreach($options as $option)
                <tr>
                    <th scope="row">{{ $option->id }}</th>
                    <td>{{ $option->domain_name }}</td>
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