<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Model_has_role;
class CheckRole
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
    
        if (!Auth::check()) {
            return redirect('/login');
        }

        $user = Auth::user();
        $rol = Model_has_role::select('model_has_roles.*')
        ->where('model_id','=',$user->id)
        ->first();
        if ($rol->role_id==1) {
            return $next($request);
        }

        return redirect('/home');
    }
        
    
}
