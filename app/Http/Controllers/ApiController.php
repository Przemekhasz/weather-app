<?php

namespace App\Http\Controllers;

use Exception;
use DateTime;
use App\Models\Cities;
use App\Models\User;
use App\Models\Data;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Console\Input\Input;
use Illuminate\Http\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;

class ApiController extends Controller
{
    private $api_key = NULL;

    public function __construct()
    {
        $this->middleware('auth');
        $this->api_key = config('api.api_key');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::all();
        $city = Cities::all();

        $find_id = User::findOrFail(Auth::user()->id);

        $query = DB::table("users")->join('cities', 'users.id', '=', 'cities.user_id')->where('users.id', '=', $find_id['id'])->select('cities.*')->get();

        $forecast = [];

        $minutes = 0;

        try {
            $forecast = Cache::remember('forecast', $minutes, function () {
                $search = request()->input('search');
                $url_to_weather = "api.openweathermap.org/data/2.5/weather?q=${search}&appid=".$this->api_key."&lang=pl";
                $client = new \GuzzleHttp\Client();
                $res = $client->get($url_to_weather);

                if($res->getStatusCode() == 200) {
                    $j = $res->getBody();
                    $obj = json_decode($j);
                    $forecast = $obj;
                }

                $lon = $forecast->coord->lon;
                $lat = $forecast->coord->lat;


                $url_to_weather = "api.openweathermap.org/data/2.5/onecall?lat=${lat}&lon=${lon}&exclude=daily&appid=".$this->api_key."&lang=pl";

                $client = new \GuzzleHttp\Client();
                $res = $client->get($url_to_weather);

                if($res->getStatusCode() == 200) {
                    $j = $res->getBody();
                    $obj = json_decode($j);
                    $forecast = $obj;
                }
                return [$forecast, $search];
            });

        } catch (\Exception $err) {
            return view("errors.404");
        }

        $name = $forecast[1];
        $icon = $forecast[0]->current->weather[0]->icon;
        $description = $forecast[0]->current->weather[0]->description;

        $forecast_icon = "http://openweathermap.org/img/wn/${icon}.png";
        $time = $forecast[0]->hourly;

        // Read and convert api data
        $temp = round($forecast[0]->current->temp - 273.15);
        $hourly_temp = $forecast[0]->hourly;
        $feels = round($forecast[0]->current->feels_like - 273.15);
        $preasure = $forecast[0]->current->pressure;
        $humidity = $forecast[0]->current->humidity;
        $hourly_humidity = $forecast[0]->hourly;
        $wind = round($forecast[0]->current->wind_speed * 3.600000);
        // convert unix to normal time + timezone
        $sunrise = date('H:i:s', $forecast[0]->current->sunrise + $forecast[0]->timezone_offset);
        $sunset = date('H:i:s', $forecast[0]->current->sunset  + $forecast[0]->timezone_offset);

        $data = [
            'name' => $name,
            'temp' => $temp,
            'feels' => $feels,
            'preasure' => $preasure,
            'humidity' => $humidity,
            'wind' => $wind,
            'sunrise' => $sunrise,
            'sunset' => $sunset,
            'forecast_icon' => $forecast_icon,
            'description' => $description,
            'query' => $query,
            'time' => $time,
            'hourly_temp' => $hourly_temp,
            'hourly_humidity' => $hourly_humidity,
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
        $city = Cities::all();
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\TreeRequest  $request
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $find_id = User::findOrFail(Auth::user()->id);

        $create = Cities::create([
            'city_name' => $request->input('search'),
            'user_id' => $find_id['id']
        ]);

        return redirect('/api?search='.$request->input('search'))->with('find_id', $find_id['id']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cities $city, Request $request)
    {
        $search = $request->input('search');

        $city->delete();

        return redirect('/api?search='.$request->input('search'));
    }
}
