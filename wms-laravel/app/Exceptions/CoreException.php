<?php

declare(strict_type=1);

namespace App\Exceptions;

use Exception;

class CoreException extends Exception
{
    public static function create(string $message, int $code):self
    {
        return new self($message, $code);
    }
}