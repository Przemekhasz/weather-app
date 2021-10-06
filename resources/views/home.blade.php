@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
                Miasto: {{ $name }}
            <br>
                Temperatura: {{ $temp }} * C
            <br>
                Odczuwalna: {{ $feels }} * C
            <br>
                Ciśnienie: {{ $preasure }} hPa
            <br>
                Wilgotność: {{ $humidity }} %
            <br>
                Wiatr: {{ $wind }} km/h
            <br>
                Wschód słońca: {{ $sunrise }}
            <br>
               Zachód słońca: {{ $sunset }}
        </div>
    </div>
</div>
@endsection
