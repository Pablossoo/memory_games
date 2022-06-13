<?php

declare(strict_types=1);

namespace Proget\Contracts;

interface Board
{
    public function createBoardWithOneWinningToken(): void;

    public function getTokenFromGivenPoint(int $tokenPositionX, int $tokenPositionY): TokenInterface;
}
