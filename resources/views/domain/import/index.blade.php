@extends('main')
@section('content')
@include('parts/navigation')
<br>
<div class="container-fluid">
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h1>Import domains</h1>
            </div>
            <div class="card-body">   
                <div class="list-group">
                    <li class="list-group-item">
                        <div>
                            @if ($importAllowed)
                                <form enctype="multipart/form-data" action="/domains/import/settings" method="POST">
                                    @csrf
                                    <div class="col mb-1">
                                        <input name="xlsx" type="file">
                                    </div>
                                    <div class="col">
                                        <input class="btn btn-success" type="submit" value="Import">
                                    </div>
                                </form>
                            @else
                                <div class="col">
                                    <div>
                                        Please wait when process of import will be ended ...
                                    </div>
                                    <input disabled class="btn btn-success" type="submit" value="Importing">
                                </div>
                            @endif
                            <div>{{ $errors->first('xlsx') }}</div>
                        </div>
                    </li>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection