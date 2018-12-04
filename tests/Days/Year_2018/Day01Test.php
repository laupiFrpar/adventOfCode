<?php

namespace Lopi\AdventOfCode\Tests\Days\Year_2018;

use PHPUnit\Framework\TestCase;
use Lopi\AdventOfCode\DayInterface;
use Lopi\AdventOfCode\Days\Year_2018\Day01;

final class Day01Test extends TestCase
{
    public function testPartOne_1(): void
    {
        $day = new Day01();
        $day->setData(['+1', '-2', '+3', '+1']);
        $result = $day->getResult(DayInterface::FIRST_PART);

        $this->assertEquals(3, $result[0]);
    }

    public function testPartOne_2(): void
    {
        $day = new Day01();
        $day->setData(['+1', '+1', '+1']);
        $result = $day->getResult(DayInterface::FIRST_PART);

        $this->assertEquals(3, $result[0]);
    }

    public function testPartOne_3(): void
    {
        $day = new Day01();
        $day->setData(['+1', '+1', '-2']);
        $result = $day->getResult(DayInterface::FIRST_PART);

        $this->assertEquals(0, $result[0]);
    }

    public function testPartOne_4(): void
    {
        $day = new Day01();
        $day->setData(['-1', '-2', '-3']);
        $result = $day->getResult(DayInterface::FIRST_PART);

        $this->assertEquals(-6, $result[0]);
    }

    public function testPartTwo_1(): void
    {
        $day = new Day01();
        $day->setData(['+1', '-2', '+3', '+1']);
        $result = $day->getResult(DayInterface::SECOND_PART);

        $this->assertEquals(2, $result[0]);
    }

    public function testPartTwo_2(): void
    {
        $day = new Day01();
        $day->setData(['+1', '-1']);
        $result = $day->getResult(DayInterface::SECOND_PART);

        $this->assertEquals(0, $result[0]);
    }

    public function testPartTwo_3(): void
    {
        $day = new Day01();
        $day->setData(['+3', '+3', '+4', '-2', '-4']);
        $result = $day->getResult(DayInterface::SECOND_PART);

        $this->assertEquals(10, $result[0]);
    }

    public function testPartTwo_4(): void
    {
        $day = new Day01();
        $day->setData(['-6', '+3', '+8', '+5', '-6']);
        $result = $day->getResult(DayInterface::SECOND_PART);

        $this->assertEquals(5, $result[0]);
    }

    public function testPartTwo_5(): void
    {
        $day = new Day01();
        $day->setData(['+7', '+7', '-2', '-7', '-4']);
        $result = $day->getResult(DayInterface::SECOND_PART);

        $this->assertEquals(14, $result[0]);
    }
}
