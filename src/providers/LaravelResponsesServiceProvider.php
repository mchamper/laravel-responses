<?php

namespace Mchamper\LaravelResponses\Providers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;
use Mchamper\LaravelResponses\ResponseSuccess;
use Mchamper\LaravelResponses\ResponseError;

class LaravelResponsesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->publishes([
            __DIR__ . '/../config/auth.php' => config_path('errors/auth.php'),
            __DIR__ . '/../config/default.php' => config_path('errors/default.php'),
            __DIR__ . '/../resources/lang/en/errors.php' => resource_path('lang/en/errors.php'),
            __DIR__ . '/../resources/lang/es/errors.php' => resource_path('lang/es/errors.php'),
        ]);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Response::macro('jsonSuccess', function ($body = null, $message = 'Ok.', $status = 200) {
            return Response::json(new ResponseSuccess($message, $body), $status);
        });

        Response::macro('jsonError', function ($message, $status = null) {
            $responseError = new ResponseError($message);

            if ($status) {
                $responseError->error->status = $status;
            }

            return Response::json($responseError, $responseError->error->status);
        });
    }
}
