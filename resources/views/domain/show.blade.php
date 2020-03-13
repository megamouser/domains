@extends('main')
@section('content')
@include('parts/navigation')

<br>

<div class="container-fluid">
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h1>Информация о домене</h1>
            </div>
            <div class="card-body">
                <ul class="list-group">
                    <li class="list-group-item">
                        Id домена: {{ $domain->id }}
                    </li>
                    <li class="list-group-item">
                        Имя домена: {{ $domain->name }}
                    </li>
                    <li class="list-group-item">
                        DA: {{ $da }}
                    </li>
                    <li class="list-group-item">
                        PA: {{ $pa }}
                    </li>
                    <li class="list-group-item">
                        MOZ: {{ $mozrank }}
                    </li>
                    <li class="list-group-item">
                        <div class="col">
                            <a href="/domains/{{ $domain->id }}/edit">Редактировать домен</a>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="col">
                            <form action="/domains/{{ $domain->id }}" method="POST">
                                @method("DELETE")
                                @csrf
                        
                                <button class="btn btn-outline-danger" type="submit">Удалить домен</button>
                            </form> 
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection