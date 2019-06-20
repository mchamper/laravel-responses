<?php

namespace Mchamper\LaravelResponses;

use Mchamper\LaravelResponses\Errors\ErrorHandler;

class ResponseError
{
    private $_identifier;
    private $_handler;
    public $error;

    public function __construct($identifier) {
        $this->_identifier = $identifier;
        $this->_handler = new ErrorHandler;

        $this->error = $this->_handler->getError($this->_identifier);
    }
}