<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Models\Token;

class EnsureTokenIsValid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if(!$request->input('token'))
        {
            return response()->json(['error' => "Token "], 403);
        }

        $token = Token::where('hash', $request->input('token'))->first();

        if (!$token) {
            return response()->json(['error' => "Token "], 403);
        }

        dd($token);
        die();

 
        return $next($request);
    }

        
}
