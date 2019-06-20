# Laravel Responses

Agregar al archivo composer.json del proyecto de Laravel:

"repositories": [
    {
        "type": "vcs",
        "url": "https://github.com/mchamper/laravel-responses.git"
    }
]

Instalar con el comando "composer require mchamper/laravel-responses".

Para utilizar esta clase con las excepciones del sistema, reemplazar el método "render" de la clase "App\Exceptions\Handler":

public function render($request, Exception $exception)
{
    return response()->jsonError($exception);
    // return parent::render($request, $exception);
}