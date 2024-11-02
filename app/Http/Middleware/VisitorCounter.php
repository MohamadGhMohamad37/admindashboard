<?php

namespace App\Http\Middleware;

use App\Models\Visitor;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

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

        // تسجيل الزيارة إذا لم يتم تسجيلها من نفس IP و User Agent اليوم
        $existingVisit = Visitor::where('ip_address', $ipAddress)
                                ->where('user_agent', $userAgent)
                                ->whereDate('created_at', now()->toDateString())
                                ->first();

        if (!$existingVisit) {
            Visitor::create([
                'ip_address' => $ipAddress,
                'user_agent' => $userAgent,
            ]);
        }

        return $next($request);
    }

}
