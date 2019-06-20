<?php

namespace Mchamper\LaravelResponses\Errors;

class Error
{
    public $code;
    public $status;
    public $message;
    public $name;
    public $type;
    public $exception;
    public $errors;

    public function __construct(array $config = null) {
        $this->code = $config['code'] ?? 0;
        $this->status = $config['status'] ?? 400;
        $this->message = $config['message'] ?? '';
        $this->name = $config['name'] ?? null;
        $this->type = \Str::studly($config['type'] ?? 'Generic') . 'Error';
        $this->exception = $config['exception'] ?? null;
        $this->errors = $config['errors'] ?? null;
    }
}