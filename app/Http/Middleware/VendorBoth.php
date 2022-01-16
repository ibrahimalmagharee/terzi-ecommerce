<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Request;

class VendorBoth
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
        if (Auth::guard('vendor')->user()->type_activity == 'أقمشة'){
            $notification = array(
                'message' => 'انت غير مصرح للك بالدخول لهذه الصفحة',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        } else {
            return $next($request);

        }
    }
}
