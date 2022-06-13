<?php

declare(strict_types=1);

namespace Proget;

final class Player
{
    private int $positionX;

    private int $positionY;

    private int $currentAttempt = 5;

    public function __construct(public readonly string $name)
    {
    }

    public function getPositionX(): int
    {
        return $this->positionX;
    }

    public function setPositionX(int $positionX): void
    {
        $this->positionX = $positionX;
    }

    public function getPositionY(): int
    {
        return $this->positionY;
    }

    public function setPositionY(int $positionY): void
    {
        $this->positionY = $positionY;
    }

    public function getCurrentAttempt(): int
    {
        return $this->currentAttempt;
    }

    public function setCurrentAttempt(int $currentAttempt): void
    {
        $this->currentAttempt = $currentAttempt;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
