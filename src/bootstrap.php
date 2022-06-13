<?php

declare(strict_types=1);

namespace Proget;

use Proget\Exception\MaximumAttemptException;
use Proget\Exception\TimeMovementExceededException;
use function rand;
use function sleep;
use function sprintf;

require __DIR__ . '/../vendor/autoload.php';
/**
 * [BOOTSTRAP FILE] [START GAME]
 */
try {
    $board        = new Board(5, 5);
    $clockManager = new ClockManager();

    $gameManager = new GameManager($clockManager, $board);
    $player1     = new Player('Test');

    echo sprintf("HELLO %s, at the beginning of the game you have 5 tries and 60 seconds to find the winning chip! Good luck !\n", $player1->getName());
    echo sprintf("START GAME: %s\n", $clockManager->getStartGameTime());
    echo sprintf("END GAME: %s\n", $clockManager->getEndGameTime());

    do {
        $player1->setPositionX(rand(1, 1));
        $player1->setPositionY(rand(1, 1));
        echo sprintf("YOUR POSITION POINT IS X %d and Y %d:\n", $player1->getPositionX(), $player1->getPositionY());
        echo sprintf("you have %d attempts yet !\n", $player1->getCurrentAttempt());
        echo sprintf("you have %d seconds yet ! \n\n", $clockManager->getCurrentGameTime());
        $isWin = $gameManager->executeStep($player1);
        if ($isWin !== 0) {
            echo "YOU ARE THE BEST ! \n";
            $isWin = true;
        }
        sleep(10);
    } while ($isWin !== true);
} catch (TimeMovementExceededException $timeMovementExceededException) {
    echo "\nYOU LOSE :(\n";
    echo $timeMovementExceededException->getMessage();
} catch (MaximumAttemptException $maximumAttemptException) {
    echo $maximumAttemptException->getMessage();
    echo "\nYOU LOSE :(";
}
