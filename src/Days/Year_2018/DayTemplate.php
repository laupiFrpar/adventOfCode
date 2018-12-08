<?php

namespace Lopi\AdventOfCode\Days\Year_2018;

use Lopi\AdventOfCode\DayInterface;

/**
 * @author Pierre-Louis Launay <laupi.frpar@gmail.com>
 */
class DayTemplate extends Day2018Abstract
{
    public function getTitle(): string
    {
        return '';
    }

    public function getDescription(): string
    {
        return <<<DESCRIPTION

DESCRIPTION;
    }

    public function getPartTwoDescription(): string
    {
        return <<<DESCRIPTION
        
DESCRIPTION;
    }

    public function getResult(int $part = DayInterface::ALL_PART): array
    {
        $result = [];

        if (DayInterface::ALL_PART === $part || DayInterface::FIRST_PART === $part) {
            $result[] = null;
        }

        if (DayInterface::ALL_PART === $part || DayInterface::SECOND_PART === $part) {
            $result[] = null;
        }

        return $result;
    }

    protected function getFilename(): string
    {
        return 'day_06.txt';
    }
}
