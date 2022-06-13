<?php

declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;
use Proget\Board;
use Proget\Exception\WrongDimensionsBoardException;
use Proget\Token;

class BoardTest extends TestCase
{
    public function testGetTokenFromGivenPoint()
    {
        $board = new Board(5, 5);
        $board->createBoardWithOneWinningToken();

        $token = $board->getTokenFromGivenPoint(3, 3);
        $this->assertInstanceOf(Token::class, $token);
    }

    public function testCreateBoardIfSizeIsOverMax()
    {
        $this->expectException(WrongDimensionsBoardException::class);
        $this->expectExceptionMessage('The dimensions given (11x11) exceed the maximum 5x5');

        new Board(11, 11);
    }

    public function testFindTokenFromSpecifiedPosition()
    {
        $board = new Board(5, 5);
        $board->createBoardWithOneWinningToken();
        $token = $board->getTokenFromGivenPoint(5, 5);
        $this->assertInstanceOf(Token::class, $token);
    }
}
