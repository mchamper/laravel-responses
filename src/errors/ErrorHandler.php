<?php

namespace Mchamper\LaravelResponses\Errors;

use Exception;
use Mchamper\LaravelResponses\Errors\Error;

class ErrorHandler
{
    private $_field;
    private $_value;
    private $_exceptionStatus;
    private $_exceptionName;
    private $_exceptionErrors;
    private $_exceptionBut;
    private $_exceptionTrace;

    public function __construct() {
        //
    }

    public function getError($identifier) {
        $this->_resolveIdentifier($identifier);

        if (!$errorConfig = $this->_getErrorConfig()) {
            $errorConfig = [
                'message' => $this->_value,
            ];
        }

        if ($this->_exceptionName) {
            $errorConfig['exception'] = $this->_exceptionName;
            $errorConfig['errors'] = $this->_exceptionErrors;
            $errorConfig['but'] = $this->_exceptionBut;

            if ($this->_exceptionStatus && !isset($errorConfig['status'])) {
                $errorConfig['status'] = $this->_exceptionStatus;
            }

            if ($this->_exceptionTrace) {
                $errorConfig['trace'] = $this->_exceptionTrace;
            }
        }

        return new Error($errorConfig);
    }

    private function _resolveIdentifier($identifier) {
        if ($identifier instanceof Exception) {
            $this->_resolveIdentifierException($identifier);
        } else {
            if (is_int($identifier)) {
                $this->_field = 'code';
            }

            if (is_string($identifier)) {
                $this->_field = 'name';
            }

            $this->_value = $identifier;
        }
    }

    private function _resolveIdentifierException(Exception $e) {
        if (config('app.debug') === true) {
            $this->_exceptionName = get_class($e);

            if (method_exists($e, 'getTrace')) {
                $this->_exceptionTrace = $e->getTrace();
            }
        } else {
            $this->_exceptionName = class_basename($e);
        }

        $this->_exceptionStatus = $this->_getExceptionStatus($e);

        if (method_exists($e, 'errors')) {
            $this->_exceptionErrors = $e->errors();
        }

        if (method_exists($e, 'but')) {
            $this->_exceptionBut = $e->but();
        }

        $identifier = $e->getMessage();

        if (is_numeric($identifier)) {
            $identifier = (int) $identifier;
        }

        $this->_resolveIdentifier($identifier);
    }

    private function _getExceptionStatus(Exception $e) {
        /**
         * Código manualmente indicado.
         */
        if ($e->getCode() >= 400 && $e->getCode() < 500) {
            return $e->getCode();
        }

        /**
         * Código automático para excepciones Http.
         */
        if (method_exists($e, 'getStatusCode')) {
            return $e->getStatusCode();
        }

        if ($e instanceof \Illuminate\Auth\AuthenticationException) {
            return 401;
        }

        if ($e instanceof \Illuminate\Auth\Access\AuthorizationException) {
            return 403;
        }

        if ($e instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
            return 404;
        }

        if ($e instanceof \Illuminate\Validation\ValidationException) {
            return 422;
        }

        /**
         * Códigos 500 para el resto de las exceptiones.
         */
        return 500;
    }

    private function _getErrorConfig() {
        $errorConfig = null;

        foreach (config('errors') as $key => $value) {
            if ($errorConfig = collect($value)->where($this->_field, $this->_value)->first()) {
                $errorConfig['type'] = $key;
                break;
            }
        }

        return $errorConfig;
    }
}
