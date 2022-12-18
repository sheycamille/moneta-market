<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Notifications\TwoFactorCode;


class TwoFactorController extends Controller
{
    public function index()
    {
        return view('auth.admin-two-factor');
    }


    public function store(Request $request)
    {
        $request->validate([
            'two_factor_code' => 'integer|required',
        ]);

        $user = auth('admin')->user();

        if($request->input('two_factor_code') == $user->two_factor_code)
        {
            $user->resetTwoFactorCode();
            $request->session()->regenerate();
            //return redirect()->intended('admin/dashboard');
             return redirect()->route('admin.dashboard');
        }

        return redirect()->back()
            ->withErrors(['two_factor_code' =>
                'The two factor code you have entered does not match']);
    }


    public function resend()
    {
        $user = auth('admin')->user();
        $user->generateTwoFactorCode();
        $user->notify(new TwoFactorCode());

        return redirect()->back()->withMessage('The two factor code has been sent again');
    }
}
