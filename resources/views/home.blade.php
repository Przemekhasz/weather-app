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
                        <div class="ct-chart ct-perfect-fourth"></div>
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
                                {{-- {{ $search }} --}}
                                <span class="time">
                                    {{-- {{ $time[0] }} --}}
                                </span>

                            </h1>
                            <h5 class="heading">{{ $description }}
                                <img src="{{ $forecast_icon }}" class="weather-image">
                            </h5>
                            <hr class="info_hr">
                            <p class="temp">
                                <span class="info">Temperatura:</span><br>
                                <span class="temp-value temperature">

                                </span>
                                <span class="deg">o</span>
                                    <a href="javascript:;"><span class="temp-type">C</span></a>
                                    <br>
                                    <span class="info">Odczuwalna: {{ $feels }}*C :</span>
                                    {{-- <span class="info">Wschód: {{ $sunrise }}</span> --}}
                                </p>
                                <hr class="info_hr">
                                <p class="temp">
                                    <span class="info">Wilgotność:</span><br>
                                    <span class="temp-value humidity">{{ $hourly_humidity[0]->humidity }}</span>
                                    <a href="javascript:;"><span class="temp-type">%</span></a>
                                </p>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    let temp = document.querySelector(".temperature").innerText;
    let humidity = document.querySelector(".humidity").innerText;
    let time = document.querySelector(".time").innerText;

    console.log(temp);
    console.log(humidity);
    console.log(time);

    let data = {
    labels: [
        <?php echo date('H', $time[0]->dt + 7200) ?>,
        <?php echo date('H', $time[1]->dt + 7200) ?>,
        <?php echo date('H', $time[2]->dt + 7200) ?>,
        <?php echo date('H', $time[3]->dt + 7200) ?>,
        <?php echo date('H', $time[4]->dt + 7200) ?>,
        <?php echo date('H', $time[5]->dt + 7200) ?>,
        <?php echo date('H', $time[6]->dt + 7200) ?>,
        <?php echo date('H', $time[7]->dt + 7200) ?>,
        <?php echo date('H', $time[8]->dt + 7200) ?>,
        <?php echo date('H', $time[9]->dt + 7200) ?>,
        <?php echo date('H', $time[10]->dt + 7200) ?>,
        <?php echo date('H', $time[11]->dt + 7200) ?>,
        <?php echo date('H', $time[12]->dt + 7200) ?>,
        <?php echo date('H', $time[13]->dt + 7200) ?>,
        <?php echo date('H', $time[14]->dt + 7200) ?>,
        <?php echo date('H', $time[15]->dt + 7200) ?>,
        <?php echo date('H', $time[16]->dt + 7200) ?>,
        <?php echo date('H', $time[17]->dt + 7200) ?>,
        <?php echo date('H', $time[18]->dt + 7200) ?>,
        <?php echo date('H', $time[19]->dt + 7200) ?>,
        <?php echo date('H', $time[20]->dt + 7200) ?>,
        <?php echo date('H', $time[21]->dt + 7200) ?>,
        <?php echo date('H', $time[22]->dt + 7200) ?>,
        <?php echo date('H', $time[23]->dt + 7200) ?>,
    ],
        series: [
        [ <?php echo $hourly_humidity[0]->humidity ?> ],
        [ <?php echo $hourly_humidity[1]->humidity ?> ],
        [ <?php echo $hourly_humidity[2]->humidity ?> ],
        [ <?php echo $hourly_humidity[3]->humidity ?> ],
        [ <?php echo $hourly_humidity[4]->humidity ?> ],
        [ <?php echo $hourly_humidity[5]->humidity ?> ],
        [ <?php echo $hourly_humidity[6]->humidity ?> ],
        [ <?php echo $hourly_humidity[7]->humidity ?> ],
        [ <?php echo $hourly_humidity[8]->humidity ?> ],
        [ <?php echo $hourly_humidity[9]->humidity ?> ],
        [ <?php echo $hourly_humidity[10]->humidity ?> ],
        [ <?php echo $hourly_humidity[11]->humidity ?> ],
        [ <?php echo $hourly_humidity[12]->humidity ?> ],
        [ <?php echo $hourly_humidity[13]->humidity ?> ],
        [ <?php echo $hourly_humidity[14]->humidity ?> ],
        [ <?php echo $hourly_humidity[15]->humidity ?> ],
        [ <?php echo $hourly_humidity[16]->humidity ?> ],
        [ <?php echo $hourly_humidity[17]->humidity ?> ],
        [ <?php echo $hourly_humidity[18]->humidity ?> ],
        [ <?php echo $hourly_humidity[19]->humidity ?> ],
        [ <?php echo $hourly_humidity[20]->humidity ?> ],
        [ <?php echo $hourly_humidity[21]->humidity ?> ],
        [ <?php echo $hourly_humidity[22]->humidity ?> ],
        [ <?php echo $hourly_humidity[23]->humidity ?> ],
    ]
    };

    let options = {
    seriesBarDistance: 34
    };

    let responsiveOptions = [
    ['screen and (min-width: 641px) and (max-width: 1024px)', {
        seriesBarDistance: 10,
        axisX: {
        labelInterpolationFnc: function (value) {
            return value;
        }
        }
    }],
    ['screen and (max-width: 640px)', {
        seriesBarDistance: 5,
        axisX: {
        labelInterpolationFnc: function (value) {
            return value[0];
        }
        }
    }]
    ];

    new Chartist.Bar('.ct-chart', data, options, responsiveOptions);
</script>
@endsection
