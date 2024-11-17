<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use App\Models\ApiRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class apiLimit
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['error' => 'User not authenticated'], 401);
        }

        // $currentMonth = now()->startOfMonth();
        $currentMonth = Carbon::now()->addMonth()->startOfMonth();

        $apiRequest= ApiRequest::where('user_id', $user->id)->first();
        // Retrieve the API request record or create a new one
        if ($apiRequest) {
            // If the month has changed, reset the month and request count
            if ($apiRequest->month != $currentMonth) {
                $apiRequest->month = $currentMonth;
                $apiRequest->request_count = 0;
            }
        } else {
            // If no record exists, create a new one
            $apiRequest = new ApiRequest([
                'user_id' => $user->id,
                'month' => $currentMonth,
                'request_count' => 0,
            ]);
        }

        // Increment request count
        $apiRequest->request_count = ($apiRequest->request_count ?? 0) + 1;

        // Check if the request count exceeds the limit
        if ($apiRequest->request_count > 50) {
            return response()->json(['error' => 'API request limit exceeded until next month'], 429);
        }

        // Save the updated record
        $apiRequest->save();

        Log::info('apiLimit middleware executed. Request count: ' . $apiRequest->request_count);



        return $next($request);
    }
}
