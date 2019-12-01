<?php

namespace App\Providers;

use Mail;
use App\User;
use App\Mail\SendActivationToken;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Braintree_Configuration;
use Laravel\Cashier\Cashier;
use App\Events\UserRegistered;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        
        Braintree_Configuration::environment(env('BRAINTREE_ENV', 'production'));
        Braintree_Configuration::merchantId(env('BRAINTREE_MERCHANT_ID', 'z9tpbbj8gpn4pd8s'));
        Braintree_Configuration::publicKey(env('BRAINTREE_PUBLIC_KEY', 'pvtrdjgjbsh2659n'));
        Braintree_Configuration::privateKey(env('BRAINTREE_PRIVATE_KEY', 'd4423d3830731d845cdac37843d57186'));

        Cashier::useCurrency('gbp', '£');

        User::created(function ($user) {

            $token = $user->activationToken()->create([
                'token' => str_random(128),
            ]);

            event(new UserRegistered($user));

        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

