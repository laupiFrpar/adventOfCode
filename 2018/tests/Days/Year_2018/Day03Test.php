<?php

namespace Lopi\AdventOfCode\Tests\Days;

use Lopi\AdventOfCode\DayInterface;
use Lopi\AdventOfCode\Days\Day03;
use PHPUnit\Framework\TestCase;

final class Day03Test extends TestCase
{
    public function testPartOne(): void
    {
        $day = new Day03();
        $day->setData(['#1 @ 1,3: 4x4', '#2 @ 3,1: 4x4', '#3 @ 5,5: 2x2']);
        $result = $day->getResult(DayInterface::FIRST_PART);

        $this->assertEquals(4, $result[0]);
    }

    public function testPartTwo(): void
    {
        $day = new Day03();
        $day->setData(['#1 @ 1,3: 4x4', '#2 @ 3,1: 4x4', '#3 @ 5,5: 2x2']);
        $result = $day->getResult(DayInterface::SECOND_PART);

        $this->assertEquals(3, $result[0]);
    }
}
