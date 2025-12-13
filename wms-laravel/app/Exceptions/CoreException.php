<?php

declare(strict_type=1);

namespace App\Exceptions;

use Exception;

abstract class CoreException extends Exception
{
    protected int $httpStatusCode = 404;

    public function getHttpStatusCode(): int
    {
        return $this->httpStatusCode;
    }
}


class AuthenticationException extends CoreException
{
    protected int $httpStatusCode = 401;
}

class NotFoundException extends CoreException
{
    protected int $httpStatusCode = 404;
}

class ValidationException extends CoreException
{
    protected int $httpStatusCode = 422;
}