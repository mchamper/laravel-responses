<?php

namespace Mchamper\LaravelResponses;

class ResponseSuccess
{
    public $message;
    public $body;

    public function __construct($message, $body) {
        $this->message = $message;
        $this->body = $body;
    }
}