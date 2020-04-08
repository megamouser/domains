@extends('main')
@section('content')
@include('parts/navigation')
<br>
<div class="container-fluid">
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h1>Экспорт доменов из csv файла</h1>
            </div>
            {{-- 
            <div class="card-body">   
                <div class="list-group">
                    <li class="list-group-item">
                        <div>
                            <form enctype="multipart/form-data" action="/domains/import/settings" method="POST">
                                @csrf
                                <input name="csv" type="file">
                                <br><br>
                                <input class="btn btn-outline-success" type="submit" value="Экспорт">
                            </form>
                        
                            <div>{{ $errors->first('csv') }}</div>
                        </div>
                    </li>
                </div>
            </div> 
            --}}
            <div class="card-body">
                <ul class="list-group">
                    <li class="list-group-item">
                        <div class="col mb-1">
                            Всего доменов: <span class="badge badge-pill badge-info p-2">{{ $domainsCount }}</span>
                        </div>
                        <div class="col">
                            <a class="btn btn-success" href="/domains/export/settings">Экспорт</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection