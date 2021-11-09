@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row align-items-center">
            <div class="col">
                <div class="weather-cardd rain">
                    <div class="top">
                        <div class="wrapper">
                            <span class="info">Wybierz miasto:</span><br>
                            @foreach ($query as $single)
                                <a href="api?search={{ $single->city_name }}">
                                        <form id="event" action="/api/{{ $single->id }}" method="POST">
                                            <label for="name">{{ $single->city_name }}
                                        @csrf
                                        @method('delete')
                                            <a href="/api/{{ $single->id }}">
                                                X
                                            </a>
                                    </form>
                                </a>
                             @endforeach

                             {{-- {{ $query->links() }} --}}

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
                                    <input type="search" class="form-control" name="search" required>
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
                                <span class="temp-value temperature">
                                    {{ $temp }}
                                </span>
                                <span class="deg">o</span>
                                    <a href="javascript:;"><span class="temp-type">C</span></a>
                                    <br>
                                    <span class="info">Odczuwalna: {{ $feels }}*C</span><br />
                                    <span class="info">Wschód: {{ $sunrise }}</span><br />
                                    <span class="info">Zachód: {{ $sunset }}</span>
                                </p>
                                <hr class="info_hr">
                                <p class="temp">
                                    <span class="info">Wilgotność:</span><br>
                                    <span class="temp-value humidity">{{ $hourly_humidity[0]->humidity }}</span>
                                    <a href="javascript:;"><span class="temp-type">%</span></a>
                                </p>
                                <span class="info">Wilgotność w czasie:</span><br>
                                <div class="ct-chart ct-perfect-fourth"></div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
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
    ]
    };

    let options = {
    seriesBarDistance: 76
    };

    let responsiveOptions = [
    ['screen and (min-width: 641px) and (max-width: 1024px)', {
        seriesBarDistance: 20,
        axisX: {
        labelInterpolationFnc: function (value) {
            return value;
        }
        }
    }],
    ['screen and (max-width: 640px)', {
        seriesBarDistance: 15,
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
