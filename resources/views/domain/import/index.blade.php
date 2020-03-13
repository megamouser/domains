@extends('main')
@section('content')
@include('parts/navigation')
<br>
<div class="container-fluid">
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h1>Ипорт доменов из csv файла</h1>
            </div>
            <div class="card-body">   
                <div class="list-group">
                    <li class="list-group-item">
                        <div>
                            <form enctype="multipart/form-data" action="/domains/import/settings" method="POST">
                                @csrf
                                <input name="csv" type="file">
                                <br><br>
                                <input class="btn btn-outline-success" type="submit" value="save">
                            </form>
                        
                            <div>{{ $errors->first('csv') }}</div>
                        </div>
                    </li>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection