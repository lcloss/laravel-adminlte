<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;

class UserVerificationController extends Controller
{
    public function approve($token)
    {
        $user = User::where('verification_token', $token)->first();
        abort_if(!$user, 404);

        $user->verified           = 1;
        $user->verified_at        = Carbon::now()->format(config('panel.timestamp_format'));
        $user->verification_token = null;
        $user->save();

        $info_messages = [
            __('auth.emailVerificationSuccess'),
        ];

        return redirect()->route('login')->with('alert-info', $info_messages);
    }
}
