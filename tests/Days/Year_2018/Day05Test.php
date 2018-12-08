<?php

namespace Lopi\AdventOfCode\Tests\Days\Year_2018;

use Lopi\AdventOfCode\DayInterface;
use Lopi\AdventOfCode\Days\Year_2018\Day05;
use PHPUnit\Framework\TestCase;

final class Day05Test extends TestCase
{
    public function testPartOne(): void
    {
        $day = new Day05();
        $day->setData(['dabAcCaCBAcCcaDA']);
        $result = $day->getResult(DayInterface::FIRST_PART);

        $this->assertEquals(10, $result[0]);
    }

    public function testPartTwo(): void
    {
        $day = new Day05();
        $day->setData(['dabAcCaCBAcCcaDA']);
        $result = $day->getResult(DayInterface::SECOND_PART);

        $this->assertEquals(4, $result[0]);
    }
}
