@extends('main')
@section('content')
@include('parts/navigation')
<br>
<div class="container-fluid">
    <div class="container">
        <h1>Домены</h1>
    </div>
</div>

<div class="container">
    @if(count($domains))
        <table class="table table-bordered table-striped rounded">
            <thead>

                <tr>
                    <th colspan="7">
                        <div class="container">
                            <div class="row">
                                <div class="col">
                                    <form class="form-inline my-2 my-lg-0" action="/domains" method="get">
                                        <input class="form-control mr-sm-2" aria-label="search" name="search" type="search" value="{{ $search }}" placeholder="Поиск">
                                        <input type="hidden" name="count" value="{{ $count }}">
                                        <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">искать</button>
                                    </form>
                                </div>
                                <div class="col text-right">
                                    <div class="my-2 my-lg-0">
                                        <form action="/domains" method="get">
                                            <input type="hidden" name="search">
                                            <input type="hidden" name="count" value="{{ $count }}">
                                            <input type="hidden" name="statistic" value="false">
                                            <button type="submit" class="btn btn-outline-primary">БЕЗ СТАТИСТИКИ</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </th>
                </tr>

                <tr>
                    <th scope="col">
                        ID
                    </th>
                    <th scope="col">
                        NAME
                    </th>
                    <th scope="col">
                        DA
                    </th>
                    <th scope="col">
                        PA
                    </th>
                    <th scope="col">
                        MOZ
                    </th>
                    <th scope="col">
                        LINKS
                    </th>
                    <th scope="col">
                        EQUITY
                    </th>
                </tr>

            </thead>
            <tbody>
                @foreach($domains as $domain)
                    <tr>
                        <th scope="row">{{ $domain->id }}</th>
                        <td><a href="/domains/{{ $domain->id }}">{{ $domain->name }}</a></td>
                        <td>{{ $domain->da }}</td>
                        <td>{{ $domain->pa }}</td>
                        <td>{{ $domain->mozrank }}</td>
                        <td>{{ $domain->links }}</td>
                        <td>{{ $domain->equity }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="container">
            <div class="row">
                <div class="col-10">
                    {{ $domains->links() }}
                </div>
                <div class="col-2">
                    <form action="/domains">
                        <input type="hidden" name="search" value="{{ $search }}">
                        <input class="form-control" type="number" name="count" value="{{ $count }}">
                    </form>
                </div>
            </div>
        </div>
    @else 
        <table class="table table-bordered table-striped rounded">
            <thead>

                <tr>
                    <th colspan="6">
                        <div class="container">
                            <form class="form-inline my-2 my-lg-0" action="/domains" method="get">
                                <input class="form-control mr-sm-2" aria-label="search" name="search" type="search" value="{{ $search }}" placeholder="Поиск">
                                <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">искать</button>
                            </form>
                        </div>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th style="text-align: center;">
                        <div style="font-weight: bolder; color: #ccc">Список пуст</div>
                    </th>
                </tr>
            </tbody>
        </table>
    @endif
</div>

<div class="container-fluid">
    <div class="container">
        <a href="domains/create">Создать домен</a>
    </div>
    <div class="container">
        <a href="/domains?search=.ru">Домены RU</a>
    </div>
    <div class="container">
        <a href="/domains?search=.com">Домены COM</a>
    </div>
</div>
@endsection