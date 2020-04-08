@extends('main')
@section('content')
@include('parts/navigation')
<br>
<div class="container">
    <table class="table table-bordered table-striped rounded">
        <thead>
            <tr>
                <th colspan="5">
                    <div class="container">
                        <form class="form-inline my-2 my-lg-0" action="/options" method="get">
                            <input class="form-control mr-sm-2" aria-label="search" name="search" type="search" value="{{ $search }}" placeholder="Поиск">
                            <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">искать</button>
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
                    <a href="{{ request()->fullUrlWithQuery(['sort' => 'domain_name']) }}">
                        Имя домена
                    </a>
                </th>
                <th scope="col">
                    <a href="{{ request()->fullUrlWithQuery(['sort' => 'da']) }}">
                        DA
                    </a>
                </th>
                <th scope="col">
                    <a href="{{ request()->fullUrlWithQuery(['sort' => 'pa']) }}">
                        PA
                    </a>
                </th>
                <th scope="col">
                    <a href="{{ request()->fullUrlWithQuery(['sort' => 'mozrank']) }}">
                        MOZ
                    </a>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach($options as $option)
                <tr>
                    <th scope="row">{{ $option->id }}</th>
                    <td><a href="/domains/{{ $option->domain_id }}">{{ $option->domain_name }}</a></td>
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
@endsection