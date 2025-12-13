<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureNoAdminExists
{
    public function handle(Request $request, Closure $next): Response
    {
        if(User::where('role', 'admin')->exists())
        {
            return redirect('/');
        }
        return $next($request);
    }
}
