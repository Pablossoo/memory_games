<?php

declare(strict_types=1);

namespace Proget\Exception;

final class TimeMovementExceededException extends \Exception
{
    public static function timeMovementExceeded(string $maxTimeWhenTurnIsEnd): self
    {
        return new self(sprintf('The time is over! You should make your move up to %s. CURRENT TIME: %s', $maxTimeWhenTurnIsEnd, (new \DateTimeImmutable())->format('Y-m-d H:i:s')));
    }
}
