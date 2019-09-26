<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if (!Auth::user()->admin){
            session()->flash('info', 'You do not have permission to perform this action');
            return redirect()->back();
        }

        return $next($request);
    }
}
