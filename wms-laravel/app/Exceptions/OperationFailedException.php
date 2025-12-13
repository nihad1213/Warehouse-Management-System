<?php

declare(strict_types=1);

namespace App\Exceptions;

use App\Exceptions\CoreException;

class OperationFailedException extends CoreException
{
    protected int $httpStatusCode = 500;
}