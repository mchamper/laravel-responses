<?php

namespace Mchamper\LaravelResponses\Errors;

use Illuminate\Support\Str;

class Error
{
    public $code;
    public $status;
    public $message;
    public $name;
    public $type;
    public $exception;
    public $errors;
    public $but;

    public function __construct(array $config = null) {
        if (function_exists('studly_case')) {
            $type = Str::studly($config['type'] ?? 'Generic') . 'Error';
        } else {
            $type = Str::studly($config['type'] ?? 'Generic') . 'Error';
        }

        $this->code = $config['code'] ?? 0;
        $this->status = $config['status'] ?? 400;
        $this->message = $config['message'] ?? '';
        $this->name = $config['name'] ?? null;
        $this->type = $type;
        $this->exception = $config['exception'] ?? null;
        $this->errors = $config['errors'] ?? null;
        $this->but = $config['but'] ?? null;

        if (isset($config['trace'])) {
            $this->trace = $config['trace'];
        }
    }
}
