<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\ApiRequest;
use App\Models\User as ModelsUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class WeatherController extends Controller
{
    //
    public function getWeather($city)
    {
        // $user= Auth::user();
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
                return \response()->json(['error'=> 'An error occurred while fetching data'],501);
            }
        }
        // $this->makeIncrementApiRequest($user->id);

        return \response()->json($weatherData);
    }

    protected function makeIncrementApiRequest($userId){
        $currentMonth = now()->startOfMonth();

        $userExisit = ApiRequest::where('user_id',$userId);
      
         ApiRequest::firstOrCreate(['user_id' => $userId, 'month'=> $currentMonth],['request_count'=> 0]);
  

        // $apiRequest = ApiRequest::firstOrCreate(['user_id' => $userId, 'month'=> $currentMonth],['request_count'=> 0]);

        // $userExisit->request_count = $userExisit->request_count + 1;
        $userExisit->increment('request_count');
    }
}



