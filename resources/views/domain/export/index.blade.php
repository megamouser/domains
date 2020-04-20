@extends('main')
@section('content')
@include('parts/navigation')
<br>
<div class="container-fluid">
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h1>Export domains</h1>
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
                            <span>Domain names available:</span>
                            <span class="badge badge-pill badge-info p-2">{{ $domainsCount }}</span>
                        </div>
                        <div class="col">
                            @if ($exportAllowed)
                                <form class="form-inline my-2" action="/domains/export/settings" method="get">
                                    <div class="input-group m-1">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">Export Count</span>
                                        </div>
                                        <select id="mySelect" class="form-control" name="startend">
                                            <option value="0-200000">0 - 200k</option>
                                            <option value="200000-400000">200k - 400k</option>
                                            <option value="400000-800000">400k - 800k</option>
                                            <option value="800000-1600000">800k - 1.6m</option>
                                            <option value="1600000-1890000">1.6m - 1.89m</option>
                                        </select>
                                        {{-- <input class="form-control" aria-label="order" name="order" type="text" value="{{ $sort }}" placeholder="Поиск"> --}}
                                    </div>

                                    <div class="input-group m-1">
                                        <button class="btn btn-success m-1" type="submit">
                                            Export
                                        </button>
                                    </div>
                                </form>
                            @else
                                <form class="form-inline my-2" action="#" method="get">
                                    {{-- 
                                    <div class="input-group m-1">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">Export Count</span>
                                        </div>
                                        <select disabled id="mySelect" class="form-control" name="startend">
                                            <option value="0-200000">0 - 200k</option>
                                            <option value="200000-400000">200k - 400k</option>
                                            <option value="400000-800000">400k - 800k</option>
                                            <option value="800000-1600000">800k - 1.6m</option>
                                            <option value="1600000-1890000">1.6m - 1.89m</option>
                                        </select>
                                    </div> 
                                    --}}

                                    <div class="input-group m-1">
                                        <button disabled class="btn btn-success m-1" type="submit">
                                            Exporting ...
                                        </button>
                                    </div>
                                </form>
                            @endif
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection