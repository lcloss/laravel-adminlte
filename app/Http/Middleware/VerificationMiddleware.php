<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;
use Illuminate\Support\Facades\Gate;

class VerificationMiddleware
{
    public function handle($request, Closure $next)
    {
        // TODO: Revise withInput() as the request input data is not returning to old() helper.

        if ( auth()->check() ) {
            // Not verified accounts
            if (!auth()->user()->verified) {
                request()->flash();

                auth()->logout();

                $info_messages = [
                    trans('auth.verifyYourEmail'),
                ];
                return redirect('login')->with('alert-info', $info_messages)->withInput();
            }

            // Tenant status
            if ( auth()->user()->tenant ) {
                if ( auth()->user()->tenant->getRawOriginal('status') != 'A' ) {
                    $tenant_status = auth()->user()->tenant->getRawOriginal('status');
                    request()->flash();

                    auth()->logout();

                    // Pending accounts
                    if ($tenant_status == 'P') {

                        $warning_messages = [
                            trans('auth.yourAccountIsPending'),
                        ];
                        return redirect('login')->with('alert-warning', $warning_messages)->withInput();
                    }

                    // Suspended accounts
                    if ($tenant_status == 'S') {
                        $warning_messages = [
                            trans('auth.yourAccountIsSuspended'),
                        ];
                        return redirect('login')->with('alert-warning', $warning_messages)->withInput();
                    }

                    // Inactive accounts
                    if ($tenant_status == 'I') {
                        $error_messages = [
                            trans('auth.thereIsAProblemWithYourAccount'),
                        ];
                        return redirect('login')->with('alert-warning', $error_messages)->withInput();
                    }
                }
            }

            // Not active accounts
            if ( auth()->user()->getRawOriginal('status') != 'A' ) {
                $user_status = auth()->user()->getRawOriginal('status');
                request()->flash();

                auth()->logout();

                // Pending accounts
                if ( $user_status == 'P' ) {

                    $warning_messages = [
                        trans('auth.yourAccountIsPending'),
                    ];
                    return redirect('login')->with('alert-warning', $warning_messages)->withInput();
                }

                // Suspended accounts
                if ( $user_status == 'S' ) {
                    $warning_messages = [
                        trans('auth.yourAccountIsSuspended'),
                    ];
                    return redirect('login')->with('alert-warning', $warning_messages)->withInput();
                }

                // Inactive accounts
                if ( $user_status == 'I' ) {
                    $error_messages = [
                        trans('auth.thereIsAProblemWithYourAccount'),
                    ];
                    return redirect('login')->with('alert-warning', $error_messages)->withInput();
                }
            }
        }

        return $next($request);
    }
}
