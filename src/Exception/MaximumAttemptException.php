<?php

declare(strict_types=1);

namespace Proget\Exception;

final class MaximumAttemptException extends \Exception
{
    public static function playerHasExceededAttemptLimit(): self
    {
        return new self('Numbers max attempt has been exceeded');
    }
}
