<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Models\Token;
use App\Models\Call;

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
            $call = Call::create(array(
                'ip' => $request->ip(),
                'url' => $request->fullUrl(),
                'result' => 'token'
            ));

            return response()->json([
                'status' => 'error',
                'message' => 'Missing token',
            ], 403);
        }

        $token = Token::where('hash', $request->input('token'))->first();

        if (!$token) {
            $call = Call::create(array(
                'ip' => $request->ip(),
                'url' => $request->fullUrl(),
                'result' => 'token'
            ));

            return response()->json([
                'status' => 'error',
                'message' => 'Invalid token',
            ], 403);
        }

        $call = Call::create(array(
            'ip' => $request->ip(),
            'url' => $request->fullUrl(),
            'token_id' => $token['id'],
            'result' => 'success'
        ));
 
        return $next($request);
    }

        
}
