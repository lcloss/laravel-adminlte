<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use App\Models\User;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        RateLimiter::for('login', function (Request $request) {
            return Limit::perMinute(5)->by($request->email.$request->ip());
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });

        // https://laravel.com/docs/8.x/fortify#authentication
        Fortify::loginView(function(){
            return view('auth.login');
        });

        // https://laravel.com/docs/8.x/fortify#customizing-user-authentication
        Fortify::authenticateUsing(function(Request $request){
            $user = User::where('email',$request->email)->first();
            if($user && Hash::check($request->password,$user->password)){
                return $user;
            }
        });

        // https://laravel.com/docs/8.x/fortify#authenticating-with-two-factor-authentication
        Fortify::twoFactorChallengeView(function () {
            return view('auth.two-factor-challenge');
        });

        // https://laravel.com/docs/8.x/fortify#registration
        Fortify::registerView(function(){
            return view('auth.register');
        });

        // https://laravel.com/docs/8.x/fortify#requesting-a-password-reset-link
        Fortify::requestPasswordResetLinkView(function () {
            return view('auth.forgot-password');
        });

        // https://laravel.com/docs/8.x/fortify#resetting-the-password
        Fortify::resetPasswordView(function ($request) {
            return view('auth.reset-password', ['request' => $request]);
        });

        // https://laravel.com/docs/8.x/fortify#email-verification
        Fortify::verifyEmailView(function () {
            return view('auth.verify-email');
        });

        // https://laravel.com/docs/8.x/fortify#password-confirmation
        Fortify::confirmPasswordView(function () {
            return view('auth.confirm-password');
        });
    }
}
