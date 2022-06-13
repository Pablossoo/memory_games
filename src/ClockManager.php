<?php

declare(strict_types=1);

namespace Proget;

use Proget\Contracts\ClockManager as ClockManagerContract;

final class ClockManager implements ClockManagerContract
{
    private const FORMAT_DATE = 'Y-m-d H:i:s';

    private \DateTimeImmutable $startGame;

    private \DateTimeImmutable $endGame;

    public function __construct()
    {
        $this->startGame = new \DateTimeImmutable();
        $this->endGame   = (new \DateTimeImmutable())->modify('+1 minute');
    }

    public function getStartGameTime(): string
    {
        return $this->startGame->format(self::FORMAT_DATE);
    }

    public function getEndGameTime(): string
    {
        return $this->endGame->format(self::FORMAT_DATE);
    }

    public function getCurrentGameTime(): int
    {
        return $this->endGame->diff(new \DateTimeImmutable())->s;
    }
}
