<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;

abstract class CoreException extends Exception
{
    protected int $httpStatusCode = 500;

    public function getHttpStatusCode(): int
    {
        return $this->httpStatusCode;
    }
}

