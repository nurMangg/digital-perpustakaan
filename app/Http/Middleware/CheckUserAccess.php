<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserAccess
{
    public function handle(Request $request, Closure $next, $permission)
    {
        $buku = $request->route('buku');

        if ($permission === 'view' && $buku->user_id !== auth()->id() && !auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized access.');
        }

        if ($permission === 'update' && $buku->user_id !== auth()->id() && !auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized access.');
        }

        if ($permission === 'delete' && $buku->user_id !== auth()->id() && !auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized access.');
        }

        return $next($request);
    }
}
