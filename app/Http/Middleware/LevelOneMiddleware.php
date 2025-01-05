<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class LevelOneMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        Log::info('Middleware 1: Before Request');

        $response = $next($request); // Passes the request to Middleware 2 or Controller

        Log::info('Middleware 1: After Response');

        $data = json_decode($response->getContent(), true);

        info($data);

        if ($data) {
            //$response->setContent(json_encode($data + ['UTC' => now()->format('d M Y h:i:s A')]));
        }

        return $response; // Passes the response back up the pipeline
    }
}
