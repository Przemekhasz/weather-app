<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class ApiController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $forecast = [];

        $minutes = 30;
        $forecast = Cache::remember('forecast', $minutes, function () {
            $api_key = config('api.api_key');
            $url = "api.openweathermap.org/data/2.5/weather?id=760727&appid=${api_key}";
            $client = new \GuzzleHttp\Client();
            $res = $client->get($url);

            if ($res->getStatusCode() == 200) {
                $j = $res->getBody();
                $obj = json_decode($j);
                $forecast = $obj;
            }
            return $forecast;
        });
        $file = asset('storage/city.list.json');
        //760727 - Radymno
        //3094802 - Kraków

        $colle = array($file);
        $name = $forecast->name;

        // Read and convert api data
        $temp = round($forecast->main->temp - 273.15);
        $feels = round($forecast->main->feels_like - 273.15);
        $preasure = $forecast->main->pressure;
        $humidity = $forecast->main->humidity;
        $wind = round($forecast->wind->speed * 3.600000);
        // convertion unix to normal time + 7200s (2h)
        $sunrise = date('H:i:s', round($forecast->sys->sunrise) + 7200);
        $sunset = date('H:i:s',$forecast->sys->sunset + 7200);

        $data = [
            'name' => $name,
            'temp' => $temp,
            'feels' => $feels,
            'preasure' => $preasure,
            'humidity' => $humidity,
            'wind' => $wind,
            'sunrise' => $sunrise,
            'sunset' => $sunset,
        ];

        return view('home', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
