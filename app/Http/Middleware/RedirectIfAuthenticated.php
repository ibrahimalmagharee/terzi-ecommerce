<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            if ($guard == 'admin'){
                return redirect(RouteServiceProvider::ADMIN);

            } elseif ($guard == 'vendor'){
                if (Auth::guard('vendor')->user()->type_activity == 'تفصيل'){
                    return redirect()->route('vendor.aboutDesign');
                }elseif (Auth::guard('vendor')->user()->type_activity == 'أقمشة'){
                    return redirect()->route('vendor.aboutFabric');
                }elseif (Auth::guard('vendor')->user()->type_activity == 'الاثنين معا'){
                    return redirect()->route('vendor.aboutBoth');
                }
            }


          elseif ($guard == 'customer'){
              return redirect(RouteServiceProvider::HOME);

          }
        }

        return $next($request);
    }
}
