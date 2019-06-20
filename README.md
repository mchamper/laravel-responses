# Laravel Responses

## Instalación

Agregar al archivo composer.json del proyecto Laravel principal este repositorio. Luego instalar con composer y publicar sus recursos.

```
"repositories": [
    {
        "type": "vcs",
        "url": "https://github.com/mchamper/laravel-responses.git"
    }
]
```

```
composer require mchamper/laravel-responses
```
```
php artisan vendor:publish --provider=Mchamper\LaravelResponses\Providers\LaravelResponsesServiceProvider
```

## Utilización

Una vez instalado tendrás disponible en el objeto Response de Laravel los siguientes métodos:

```
response()->jsonSuccess($message, $status = 200);
response()->jsonError($message, $status = 400);
```

Para utilizar estos métodos con todas las excepciones del sistema sólo debes reemplazar el método "render" de la clase "App\Exceptions\Handler".

```
public function render($request, Exception $exception)
{
    return response()->jsonError($exception);
}
```