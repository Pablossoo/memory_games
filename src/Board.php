<?php

declare(strict_types=1);

namespace Proget;

use Proget\Contracts\Board as BoardContract;
use Proget\Contracts\TokenInterface;
use Proget\Exception\WrongDimensionsBoardException;

final class Board implements BoardContract
{
    private const MAX_COLUMNS = 5;

    private const MAX_ROWS = 5;

    private array $board = [];

    public function __construct(
        private readonly int $columns = 5,
        private readonly int $rows = 5
    ) {
        if ($this->columns > self::MAX_COLUMNS || $this->rows > self::MAX_ROWS) {
            throw WrongDimensionsBoardException::wrongDimensionsBoard($this->columns, $this->rows);
        }
    }

    public function createBoardWithOneWinningToken(): void
    {
        $this->board = $this->generateBoardWithOneWinningToken();
        $this->randPositionToken()->setIsWinning();
    }

    public function getTokenFromGivenPoint(int $tokenPositionX, int $tokenPositionY): TokenInterface
    {
        return $this->board[$tokenPositionX][$tokenPositionY];
    }

    private function generateBoardWithOneWinningToken(): array
    {
        $board = [];

        for ($i = 1; $i <= $this->columns; ++$i) {
            for ($j = 1; $j <= $this->rows; ++$j) {
                $board[$i][$j] = new Token();
            }
        }

        return $board;
    }

    private function randPositionToken(): TokenInterface
    {
        return $this->board[rand(1, 5)][rand(1, 5)];
    }
}
