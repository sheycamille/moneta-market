<?php

namespace App\Http\Middleware;

use Closure;

class TwoFactor
{

    public function handle($request, Closure $next)
    {
        $user = auth('admin')->user();

        if (auth('admin')->check() && $user->two_factor_code) {
            if ($user->two_factor_expires_at->lt(now())) {
                $user->resetTwoFactorCode();
                auth('admin')->logout();

                return redirect()->route('login')
                    ->withMessage('The two factor code has expired. Please login again.');
            }

            if (!$request->is('verify*')) {
                return redirect()->route('verify.index');
            }
        }

        return $next($request);
    }
}
