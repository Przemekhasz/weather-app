@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="row">
                <div class="weather-card one">
                    <div class="top">
                        <div class="wrapper">
                            <h1>Weather App</h1>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        {{-- @foreach ($query as $single)
                            <a href="?search={{ $single->city_name }}">
                                <div class="card" style="width: 12rem;">
                                    <img src="https://www.pzw.org.pl/pliki/prezentacje/689/logo/_radymno_logo.jpg" class="card-img-top">
                                    <div class="card-body">
                                    <h5 class="card-title">{{ $single->city_name }}</h5>

                                    <form action="/tree/{{ $single->id }}" method="POST">
                                        @csrf
                                        @method('delete')
                                            <a href="/api/{{ $single->id }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                                </svg>
                                            </a>
                                    </form>
                                    </div>
                                </div>
                            </a>
                        @endforeach --}}
                    </div>
                </div>
                <div class="weather-cardd rain">
                    <div class="top">
                        <div class="wrapper">
                            <form method="POST" action="/api?search=Warszawa" enctype="multipart/form-data">
                                @csrf
                                <div class="input-group form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                                            </svg>
                                        </span>
                                    </div>
                                    <input type="search" class="form-control" name="search">
                                </div>
                            </form>
                            <h1 class="location">
                                {{ $name }}
                            </h1>

                            <h5 class="heading">{{ $description }}
                                <img src="{{ $forecast_icon }}" class="weather-image">
                            </h5>
                            <hr class="info_hr">
                            <p class="temp">
                                <span class="info">Temperatura:</span><br>
                                <span class="temp-value">{{ $temp }}</span>
                                <span class="deg">o</span>
                                <a href="javascript:;"><span class="temp-type">C</span></a>
                                <br>
                                <span class="info">Odczuwalna: {{ $feels }} :</span>
                                <span class="info">Wschód: {{ $sunrise }}</span>
                            </p>
                            <hr class="info_hr">
                            <p class="temp">
                                <span class="info">Wilgotność:</span><br>
                                <span class="temp-value">{{ $humidity }}</span>
                                <a href="javascript:;"><span class="temp-type">%</span></a>
                            </p>

                            <div class="row chart">
                                <div class="progress progress-bar-vertical">
                                    <div class="progress-bar progress-striped" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="60" style="height:{{ $temp }}%;">{{ $temp }}</div>
                                </div>
                                <div class="progress progress-bar-vertical">
                                    <div class="progress-bar progress-striped" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="60" style="height:{{ $humidity }}%; background-color: blue">{{ $humidity }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>
<div class="row change">
    <div class="weather-card one">
        <div class="top">
            <div class="wrapper">
                <h1>Wykresy</h1>
            </div>
        </div>
        <div class="row justify-content-center">

        </div>
    </div>
</div>
<script>

</script>
@endsection
