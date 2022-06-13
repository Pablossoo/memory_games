<?php

declare(strict_types=1);

namespace Proget;

use Proget\Contracts\TokenInterface;

final class Token implements TokenInterface
{
    private string $status = 'cover';

    private bool $isWinning = false;

    public function changePageToken(): self
    {
        if ($this->status === 'uncover') {
            throw new \Exception("This token has been uncovered already!\n");
        }

        if ($this->status === 'cover') {
            $this->status = 'uncover';
        }

        return $this;
    }

    public function setIsWinning(): void
    {
        $this->isWinning = true;
    }

    public function isWinning(): bool
    {
        return $this->isWinning;
    }
}
