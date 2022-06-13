<?php

declare(strict_types=1);

namespace Proget\Exception;

final class WrongDimensionsBoardException extends \Exception
{
    public static function wrongDimensionsBoard(int $columns, int $rows): self
    {
        return new self(sprintf('The dimensions given (%dx%d) exceed the maximum 5x5', $columns, $rows));
    }
}
