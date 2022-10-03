<?php

namespace Zaoob\Laravel\Tokenable\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Throwable;
use Zaoob\Laravel\Tokenable\Models\Token;

class ZaoobTokenMiddleware
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
        try {
            $request_token = $request->bearerToken();
            $token = Token::where('token', $request_token)->first();
            $request->macro('model', function ($model = null) use ($token) {
                return $token->model($model);
            });
            return $next($request);
        } catch (Throwable $e) {
            abort(401);

        }
    }
}
