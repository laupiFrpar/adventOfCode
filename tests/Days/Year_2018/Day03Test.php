<?php

namespace Lopi\AdventOfCode\Tests\Days\Year_2018;

use Lopi\AdventOfCode\DayInterface;
use Lopi\AdventOfCode\Days\Year_2018\Day03;
use PHPUnit\Framework\TestCase;

final class Day02Test extends TestCase
{
    public function testPartOne_1(): void
    {
        $day = new Day03();
        $day->setData(['#1 @ 1,3: 4x4', '#2 @ 3,1: 4x4', '#3 @ 5,5: 2x2']);
        $result = $day->getResult(DayInterface::FIRST_PART);

        $this->assertEquals(4, $result[0]);
    }

    public function testPartTwo(): void
    {
    }
}
