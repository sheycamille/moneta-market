<?php

namespace App\Http\Middleware;

use Closure;

class TwoFactorVerify
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
        $user = auth()->user();

        if(auth()->check() && $user->enable_2fa)
        {
            if($user->token_2fa_expiry->lt(now()))
            {
                $user->resetTwoFactorCode();
                auth()->logout();

                return redirect()->route('home')
                    ->with('message', 'The two factor code has expired. Please login again.');
            }

            /*if(!$request->is('verify*'))
            {
                return redirect()->route('verify.index');
            }*/
        }

        return $next($request);
    }
}
