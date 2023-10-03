<?php

namespace App\Http\Middleware;

use Closure;

class UserActivityMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (auth()->check()) {
            $this->updateLastSeen();
        }

        return $next($request);
    }

    private function updateLastSeen()
    {
        auth()->user()->update(['last_seen_at' => now()]);
    }
}
