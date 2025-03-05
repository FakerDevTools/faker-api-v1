<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Models\Token;
use App\Models\Call;
use App\Models\Ip;

class EnsureTokenIsValid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        // No token is provided
        if(!$request->input('token'))
        {
            $call = Call::create(array(
                'address' => $request->ip(),
                'url' => $request->fullUrl(),
                'result' => 'token',
            ));

            return response()->json([
                'status' => 'error',
                'message' => 'Missing token',
            ], 403);
        }

        // Demo token is provided
        if($request->input('token') == 'demo')
        {
            $call = Call::create(array(
                'address' => $request->ip(),
                'url' => $request->fullUrl(),
                'result' => 'demo',
            ));

            return $next($request);
        }

        // Fetch the token record using the hash
        $token = Token::where('hash', $request->input('token'))->first();

        // Check if the IP address is already in use
        $ip = Ip::where('address', $request->ip())->first();

        // If there is no IP add one
        if(!$ip)
        {
            $ip = Ip::create([
                'address' => $request->ip(),
                'application_id' => $token['application_id'],
            ]);
        }

        if (!$token) {
            $call = Call::create(array(
                'address' => $request->ip(),
                'url' => $request->fullUrl(),
                'result' => 'token',
            ));

            return response()->json([
                'status' => 'error',
                'message' => 'Invalid token',
            ], 403);
        }

        $call = Call::create(array(
            'address' => $request->ip(),
            'url' => $request->fullUrl(),
            'token_id' => $token['id'],
            'ip_id' => $ip['id'],
            'result' => 'success',
        ));
 
        die('SUCCESS');

        return $next($request);
    }

        
}
