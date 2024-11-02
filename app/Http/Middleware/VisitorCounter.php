<?php

namespace App\Http\Middleware;

use App\Models\Visitor;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Stevebauman\Location\Facades\Location;

class VisitorCounter
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $ipAddress = $request->ip();
        $userAgent = $request->userAgent();
        
        // Get location information based on IP address
        $location = Location::get($ipAddress);
        $country = $location ? $location->countryName : 'Unknown';

        // Log visit if not logged from same IP and User Agent today
        $existingVisit = Visitor::where('ip_address', $ipAddress)
                                ->where('user_agent', $userAgent)
                                ->whereDate('created_at', now()->toDateString())
                                ->first();

        if (!$existingVisit) {
            Visitor::create([
                'ip_address' => $ipAddress,
                'user_agent' => $userAgent,
                'country' => $country,
            ]);
        }

        return $next($request);
    }


}
