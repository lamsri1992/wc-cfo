<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use DB;

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
        $credit = DB::table('creditors')->get();
        $type   = DB::table('d_type')->get();
        $dstat  = DB::table('d_status')->get();
        view()->share('credit', $credit);
        view()->share('type', $type);
        view()->share('dstat', $dstat);
    }
}
