<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SocialMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): mixed
    {
        $services = ['facebook','twitter','google','linkedin','github','gitlab','bitbucket'];
        $enableServices  = [];
        foreach ($services as $service) {
            if (config('services'.$service)) $enableServices[] = $service;
        }
        if (!in_array(strtolower($request->service), $enableServices)){
            if ($request->expectsJson()){
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid social Service',
                ],403);
            }else {
                redirect()->back();
            }
        }
        return $next($request);
    }
}
