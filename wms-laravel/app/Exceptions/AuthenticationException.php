<?php

declare(strict_types=1);

namespace App\Exceptions;

use App\Exceptions\CoreException;

class AuthenticationException extends CoreException
{
    protected int $httpStatusCode = 401;
}