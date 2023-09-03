<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class JsonResponseFormatter
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // Check if the response is not already a JSON response
        if (!$response->isJson()) {
            return $response;
        }

        // Modify the JSON response structure as needed
        $originalData = $response->getOriginalContent();

        // You can customize the response format here
        $formattedData = [
            'status' => 'success',
            'data' => $originalData,
        ];

        // Replace the response content with the formatted data
        $response->setContent(json_encode($formattedData));

        return $response;
    
    }
}
