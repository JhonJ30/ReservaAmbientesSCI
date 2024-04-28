<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Ambiente;
use App\Models\Reservar;
use Illuminate\Support\Facades\Auth; 

class AmbientesMiddleware
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
        // $ambientes = Ambiente::all();
        $userId = Auth::id();
    
        $ambientes = Reservar::where('codUser', $userId)->get();

        // Compartir los ambientes con todas las vistas
        view()->share('ambientes', $ambientes);
        return $next($request);
    }
}

