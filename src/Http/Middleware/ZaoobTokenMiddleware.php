<?php

namespace Zaoob\Laravel\Tokenable\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
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
        $request_token = $request->bearerToken();

        $token = Token::where('token', $request_token)
            ->where('expires_at', '<', Carbon::now())
            ->firstOr(function () {
                abort(401);
            });

        $request->macro('model', function ($model = null) use ($token) {
            return $token->model($model);
        });

        return $next($request);
    }
}
