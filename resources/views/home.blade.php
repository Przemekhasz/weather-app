@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row align-items-center">
            <div class="col">
                <div class="weather-card one">
                    <div class="top">
                        <div class="wrapper">
                            <h1>Weather App</h1>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        @foreach ($query as $single)
                            <a href="?search={{ $single->city_name }}">
                                <div class="card" style="width: 12rem;">
                                    <div class="card-body">
                                    <h5 class="card-title">{{ $single->city_name }}</h5>
                                    </div>
                                </div>
                            </a>
                        @endforeach

                    </div>

                </div>
            </div>

            <div class="col">
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
                                    <span class="info">Odczuwalna: {{ $feels }}*C :</span>
                                    <span class="info">Wschód: {{ $sunrise }}</span>
                                </p>
                                <hr class="info_hr">
                                <p class="temp">
                                    <span class="info">Wilgotność:</span><br>
                                    <span class="temp-value">{{ $humidity }}</span>
                                    <a href="javascript:;"><span class="temp-type">%</span></a>
                                </p>
                                <div class="progress-bar-sub">
                                    <div class="progress-name"><strong style="color: white;">Temperatura</strong></div>
                                    <div class="progress">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="60" style="max-width: 60%; width: {{ $temp }}%;"><span>{{ $temp }}*C</span></div>
                                </div>

                            </div>
                            <div class="progress-bar-sub">
                                <div class="progress-name"><strong style="color: white;">Wilgotność</strong></div>
                                <div class="progress">
                            <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="60" style="width: {{ $humidity }}%;"><span>{{ $humidity }}%</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
