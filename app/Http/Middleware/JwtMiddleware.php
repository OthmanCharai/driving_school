<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

class JwtMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(Request): (Response|RedirectResponse) $next
     * @return JsonResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->hasCookie(env('JWT_COOKIE_NAME'))) {
            $token = $request->cookie(env('JWT_COOKIE_NAME'));
            $request->headers->add([
                'Authorization' => 'Bearer ' . $token
            ]);
        }
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (TokenInvalidException $e) {
            return response()->json(['status' => 'unauthorized'])->setStatusCode(419);
        } catch (TokenExpiredException $e) {
            return response()->json(['status' => 'Token is Expired'])->setStatusCode(419);
        } catch (Exception $e) {
            return response()->json(['status' => 'unauthorized'])->setStatusCode(419);
        }
        return $next($request);
    }
}
