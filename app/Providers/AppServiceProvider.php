<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Pagination\Paginator;

use Auth;
use App\Models\EduProviderUsers;

class AppServiceProvider extends ServiceProvider
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
        // BOTH ARE WORKING
        // $authId = Auth::guard('provider')->id();
        // $data['userInfo'] = EduProviderUsers::where('valid', 1)->find($authId);
        // View::share($data);
        Paginator::defaultView('pagination::simple-default');
        view()->composer(
            'provider.layouts.default',
            function ($view)
            {
                $authId = Auth::guard('provider')->id();
                $data['userInfo'] = EduProviderUsers::where('valid', 1)->find($authId);
                $view->with($data);
            }
        );
    }
}
