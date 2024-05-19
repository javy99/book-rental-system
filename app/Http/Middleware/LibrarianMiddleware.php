<?php

namespace App\Http\Middleware;

use Closure;

class LibrarianMiddleware
{
    public function handle($request, Closure $next)
    {
        if (auth()->user() && auth()->user()->is_librarian) {
            return $next($request);
        }

        return redirect()->route('main')->with('error', 'You do not have permission to access this resource.');
    }
}
