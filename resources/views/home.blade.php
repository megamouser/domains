@extends('main')
@section('content')
@include('parts/navigation')
<br>
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Главная</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div>
                        Вы вошли как: {{ Auth::user()->name }}
                    </div>
                    <div>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Выйти</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<br>

{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Импорт / Экспорт</div>

                <div class="card-body">
                    <div>При импорте файла <br> test</div>
                </div>
            </div>
        </div>
    </div>
</div> --}}

@endsection
