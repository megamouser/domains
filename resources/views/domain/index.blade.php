@extends('main')
@section('content')

@include('parts/navigation')

<br>

<div class="container">
    <table class="table table-bordered table-striped rounded">
        <thead>
            <tr>
                <th colspan="3">
                    <div class="container">
                        <form class="form-inline my-2 my-lg-0" action="/domains" method="get">
                            <input class="form-control mr-sm-2" aria-label="search" name="search" type="search" value="{{ $search }}" placeholder="Полнотекстовый поиск">
                            <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">поиск</button>
                        </form>
                    </div>
                </th>
            </tr>
            <tr>
                <th scope="col">
                    <a href="{{ request()->fullUrlWithQuery(['sort' => 'id']) }}">
                        ID
                    </a>
                </th>
                <th scope="col">
                    <a href="{{ request()->fullUrlWithQuery(['sort' => 'name']) }}">
                        Имя
                    </a>
                </th>
                <th scope="col">
                    <a href="{{ request()->fullUrlWithQuery(['sort' => 'created_at']) }}">
                        Создан
                    </a>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach($domains as $domain)
                <tr>
                    <th scope="row">{{ $domain->id }}</th>
                    <td><a href="/domains/{{ $domain->id }}">{{ $domain->name }}</a></td>
                    <td>{{ $domain->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="container-fluid">
    {{ $domains->links() }}
</div>

<div class="container">
    <a href="domains/create">Создать домен</a>
</div>

<div class="container">
    <a href="domains/import">Импортировать домены из csv</a>
</div>
@endsection