<?php

namespace App\Http\Controllers;

use App\Models\Cities;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Console\Input\Input;

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
        $user = User::all();
        $city = Cities::all();

        $find_id = User::findOrFail(Auth::user()->id);

        $query = DB::table("users")->join('cities', 'users.id', '=', 'cities.user_id')->where('users.id', '=', $find_id['id'])->select('cities.*')->get();

        $forecast = [];

        $minutes = 0;
        $forecast = Cache::remember('forecast', $minutes, function () {
            $api_key = config('api.api_key');
            $search = request()->input('search');

            $url = "api.openweathermap.org/data/2.5/weather?q=${search}&appid=${api_key}&lang=pl";
            $client = new \GuzzleHttp\Client();
            $res = $client->get($url);

            if($res->getStatusCode() == 200) {
                $j = $res->getBody();
                $obj = json_decode($j);
                $forecast = $obj;
            }
            return $forecast;
        });

        $name = $forecast->name;
        $icon = $forecast->weather[0]->icon;
        $description = $forecast->weather[0]->description;

        $forecast_icon = "http://openweathermap.org/img/wn/${icon}.png";

        // Read and convert api data
        $temp = round($forecast->main->temp - 273.15);
        $feels = round($forecast->main->feels_like - 273.15);
        $preasure = $forecast->main->pressure;
        $humidity = $forecast->main->humidity;
        $wind = round($forecast->wind->speed * 3.600000);
        // convert unix to normal time + timezone
        $sunrise = date('H:i:s', $forecast->sys->sunrise + $forecast->timezone);
        $sunset = date('H:i:s', $forecast->sys->sunset + $forecast->timezone);

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
            'query' => $query
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
}
