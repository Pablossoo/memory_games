<?php

declare(strict_types=1);

namespace Proget;

use Proget\Exception\MaximumAttemptException;
use Proget\Exception\TimeMovementExceededException;

final class GameManager
{
    public function __construct(
        private readonly \Proget\Contracts\ClockManager $clockManager,
        private readonly \Proget\Contracts\Board $board
    ) {
        $this->board->createBoardWithOneWinningToken();
    }

    public function executeStep(Player $player): int
    {
        if ($this->isPlayerCanMove($player->getPositionX(), $player->getPositionY(), $this->clockManager->getCurrentGameTime(), $player->getCurrentAttempt())) {
            $token = $this->board->getTokenFromGivenPoint($player->getPositionX(), $player->getPositionY());

            try {
                if ($token->changePageToken()->isWinning()) {
                    return 1;
                }

                $player->setCurrentAttempt($player->getCurrentAttempt() - 1);
            } catch (\Exception $exception) {
                echo $exception->getMessage();
                $player->setCurrentAttempt($player->getCurrentAttempt());
            }
        }

        return 0;
    }

    private function isPlayerCanMove(int $tokenPositionX, int $tokenPositionY, int $remainingTimeToEndInSeconds, int $playerAttempt): bool
    {
        if (($tokenPositionX > 5 || $tokenPositionX <= 0) || ($tokenPositionY > 5 || $tokenPositionY <= 0)) {
            throw new \OutOfBoundsException('range is out! You can try using point position between 1 and 5');
        }

        if ($remainingTimeToEndInSeconds <= 0) {
            throw TimeMovementExceededException::timeMovementExceeded($this->clockManager->getEndGameTime());
        }

        if ($playerAttempt <= 0) {
            throw MaximumAttemptException::playerHasExceededAttemptLimit();
        }

        return true;
    }
}
