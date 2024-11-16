<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WeatherController extends Controller
{
    //
    public function getWeather($city)
    {
        $cacheKey = "weather_{$city}";

        $weatherData = Cache::get($cacheKey);

        if(!$weatherData){
            try{
                
                $apiKey = \env('API_KEY');
                $apiUrl = \env('API_URL')."{$city}?key={$apiKey}";

                $response = Http::get($apiUrl);

                if($response->failed())
                {
                    return \response()->json(['error'=>'Failed to feth weather data']);
                }

                $weatherData = $response->json();

                Cache::put($cacheKey, $weatherData, \now()->addHours(12));

            }catch (Exception $e)
            {
                Log::error("Weather API error: {$e->getMessage()}");
                return \response()->json(['error'=> 'An error occurred while fetching data']);
            }
        }
        return \response()->json($weatherData);
    }
}
