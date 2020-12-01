<?php

namespace Lopi\AdventOfCode\Tests\Days;

use Lopi\AdventOfCode\DayInterface;
use Lopi\AdventOfCode\Days\Day06;
use PHPUnit\Framework\TestCase;

final class Day06Test extends TestCase
{
    protected $day;

    public function __before()
    {
        $this->day = new Day06();
        $this->day->setData(['1,1', '1,6', '8,3', '3,4', '5,5', '8,9']);
    }
    public function testPartOne(): void
    {
        $result = $day->getResult(DayInterface::FIRST_PART);

        $this->assertEquals(17, $result[0]);
    }

    public function testPartTwo(): void
    {
        $this->markTestSkipped();

        $result = $day->getResult(DayInterface::SECOND_PART);

        $this->assertEquals(17, $result[0]);
    }
}
