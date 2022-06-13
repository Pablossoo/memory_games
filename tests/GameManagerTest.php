<?php

declare(strict_types=1);

namespace Tests;

use Exception;
use OutOfBoundsException;
use PHPUnit\Framework\TestCase;
use Proget\Contracts\Board;
use Proget\Contracts\ClockManager;
use Proget\Contracts\TokenInterface;
use Proget\Exception\MaximumAttemptException;
use Proget\Exception\TimeMovementExceededException;
use Proget\GameManager;
use Proget\Player;
use Proget\Token;

class GameManagerTest extends TestCase
{
    public function testExecuteStepSuccess()
    {
        $player = new Player('test');
        $player->setPositionX(1);
        $player->setPositionY(1);

        $boardMock    = $this->createMock(Board::class);
        $clockManager = $this->createMock(ClockManager::class);

        $clockManager->expects($this->once())
            ->method('getCurrentGameTime')
            ->willReturn(1);

        $gameManager = new GameManager($clockManager, $boardMock);
        $gameManager->executeStep($player);
    }

    public function testExceedGameTime()
    {
        $player = new Player('test');
        $player->setPositionX(1);
        $player->setPositionY(1);

        $boardMock    = $this->createMock(Board::class);
        $clockManager = $this->createMock(ClockManager::class);

        $clockManager->expects($this->once())
            ->method('getCurrentGameTime')
            ->willReturn(0);

        $this->expectException(TimeMovementExceededException::class);
        $this->expectExceptionMessage(sprintf('The time is over! You should make your move up to %s. CURRENT TIME: %s', $clockManager->getEndGameTime(), (new \DateTimeImmutable())->format('Y-m-d H:i:s')));

        $gameManager = new GameManager($clockManager, $boardMock);
        $gameManager->executeStep($player);
    }

    public function testUserExceededMaxAttempts()
    {
        $player = new Player('test');
        $player->setPositionX(1);
        $player->setPositionY(1);
        $player->setCurrentAttempt(0);

        $boardMock    = $this->createMock(Board::class);
        $clockManager = $this->createMock(ClockManager::class);


        $clockManager->expects($this->once())
            ->method('getCurrentGameTime')
            ->willReturn(10);

        $this->expectException(MaximumAttemptException::class);
        $this->expectExceptionMessage('Numbers max attempt has been exceeded');

        $gameManager = new GameManager($clockManager, $boardMock);
        $gameManager->executeStep($player);
    }

    public function testUserPutPointWhichIsOutOfBoard()
    {
        $player = new Player('test');
        $player->setPositionX(6);
        $player->setPositionY(6);

        $boardMock    = $this->createMock(Board::class);
        $clockManager = $this->createMock(ClockManager::class);

        $this->expectException(OutOfBoundsException::class);
        $this->expectExceptionMessage('range is out! You can try using point position between 1 and 5');

        $clockManager->expects($this->never())
            ->method('getStartGameTime')
            ->willReturn('2022-06-12 12:00:00');

        $gameManager = new GameManager($clockManager, $boardMock);
        $gameManager->executeStep($player);
    }

    public function testFindWinningToken()
    {
        $player = new Player('test');
        $player->setPositionX(4);
        $player->setPositionY(4);

        $token = new Token();
        $token->setIsWinning();

        $boardMock    = $this->createMock(Board::class);
        $clockManager = $this->createMock(ClockManager::class);

        $clockManager->expects($this->once())
            ->method('getCurrentGameTime')
            ->willReturn(10);

        $boardMock->expects($this->once())
            ->method('getTokenFromGivenPoint')
            ->willReturn($token);

        $gameManager = new GameManager($clockManager, $boardMock);

        $result = $gameManager->executeStep($player);
        $this->assertTrue((bool) $result);
        $this->assertIsInt($result);
    }

    public function testExceptionIfUserAgainUncoverToken()
    {
        $player = new Player('test');
        $player->setPositionX(4);
        $player->setPositionY(4);

        $boardMock    = $this->createMock(Board::class);
        $clockManager = $this->createMock(ClockManager::class);
        $token        = $this->createMock(TokenInterface::class);

        $token->expects($this->once())
            ->method('changePageToken')
            ->willThrowException(new Exception());

        $clockManager->expects($this->once())
            ->method('getCurrentGameTime')
            ->willReturn(10);

        $boardMock->expects($this->once())
            ->method('getTokenFromGivenPoint')
            ->willReturn($token);

        $gameManager = new GameManager($clockManager, $boardMock);
        $gameManager->executeStep($player);
    }
}
