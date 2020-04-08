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
            <div class="card-body pb-0">
                <ul class="list-group">
                    <li class="list-group-item">
                        <b>id:</b> <span class="badge badge-info">{{ $domain->id }} </span>
                    </li>
                    <li class="list-group-item">
                        <b>name:</b> <span class="badge badge-info">{{ $domain->name }} </span>
                    </li>
                    {{-- 
                    <li class="list-group-item">
                        DA: {{ $da }}
                    </li>
                    <li class="list-group-item">
                        PA: {{ $pa }}
                    </li>
                    <li class="list-group-item">
                        MOZ: {{ $mozrank }}
                    </li> 
                    --}}
                </ul>
            </div>
            <div class="card-body">
                 <h4>Статистика</h4>

                @if ($domain->json_params)                    
                    <ul class="list-group">
                        <li class="list-group-item">
                            <b>da: </b> <span class="badge badge-success">{{ $domain->da }}</span>
                        </li>
                        <li class="list-group-item">
                            <b>pa: </b> <span class="badge badge-success">{{ $domain->pa }}</span>
                        </li>
                        <li class="list-group-item">
                            <b>mozrank: </b> <span class="badge badge-success">{{ $domain->mozrank }}</span>
                        </li>
                        <li class="list-group-item">
                            <b>links: </b> <span class="badge badge-success">{{ $domain->links }}</span>
                        </li>
                        <li class="list-group-item">
                            <b>equity: </b> <span class="badge badge-success">{{ $domain->equity }}</span>
                        </li>
                    </ul>
                @else
                    <ul class="list-group">
                        <li class="list-group-item">
                            Статистика не найдена: <a href="/domains/{{ $domain->id }}/getparams">собрать статистику для этого домена</a>
                        </li>
                    </ul>
                @endif
            </div>
            <div class="card-body">
                <h4>Действия</h4>
                <ul class="list-group">
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