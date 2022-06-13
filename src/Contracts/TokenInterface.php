<?php

declare(strict_types=1);

namespace Proget\Contracts;

interface TokenInterface
{
    public function isWinning(): bool;

    public function changePageToken(): self;

    public function setIsWinning(): void;
}
