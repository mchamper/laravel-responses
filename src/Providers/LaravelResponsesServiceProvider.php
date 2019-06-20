<?php

namespace Mchamper\LaravelResponses\Providers;

use Illuminate\Support\ServiceProvider;

class LaravelResponsesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        \Response::macro('jsonSuccess', function ($body = null, $message = 'Ok.', $status = 200) {
            return \Response::json([
                'message'  => $message,
                'body' => $body,
            ], $status);
        });

        \Response::macro('jsonError', function ($message, $status = 400) {
            return \Response::json([
                'error'  => [
                    'code' => 0,
                    'message' => $message
                ]
            ], $status);
        });
    }
}
