<?php

namespace App\Providers;

use App\Transaction;
use Illuminate\Support\ServiceProvider;

class ViewComposeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('partials._nav', function($view) {
            $view->with('money', Transaction::wholeCash());
        });

        view()->composer('transactions.transactions', function($view) {
            $view->with('moneyPerDay', Transaction::moneyPerDay());
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
