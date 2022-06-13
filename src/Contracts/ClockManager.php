<?php

declare(strict_types=1);

namespace Proget\Contracts;

interface ClockManager
{
    public function getStartGameTime(): string;

    public function getEndGameTime(): string;

    public function getCurrentGameTime(): int;
}
