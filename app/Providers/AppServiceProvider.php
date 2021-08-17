<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Request;

use App\Models\Client;
use App\Exceptions\AuthenticationException;

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
        Request::macro('setAuthenticatedClient', function (Client $client) {
            $this->_authenticatedClient = $client;
        });

        Request::macro('getAuthenticatedClient', function () {
            if (!$this->_authenticatedClient) {
                throw new AuthenticationException("No authentication client present in request");
            }

            return $this->_authenticatedClient;
        });
    }
}
