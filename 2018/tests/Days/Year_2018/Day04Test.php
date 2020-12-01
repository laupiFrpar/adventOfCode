<?php

namespace Lopi\AdventOfCode\Tests\Days;

use Lopi\AdventOfCode\DayInterface;
use Lopi\AdventOfCode\Days\Day04;
use PHPUnit\Framework\TestCase;

final class Day04Test extends TestCase
{
    public function testPartOne(): void
    {
        $day = new Day04();
        $day->setData([
            '[1518-11-01 00:00] Guard #10 begins shift',
            '[1518-11-05 00:45] falls asleep',
            '[1518-11-01 23:58] Guard #99 begins shift',
            '[1518-11-01 00:25] wakes up',
            '[1518-11-01 00:30] falls asleep',
            '[1518-11-01 00:05] falls asleep',
            '[1518-11-02 00:40] falls asleep',
            '[1518-11-02 00:50] wakes up',
            '[1518-11-03 00:05] Guard #10 begins shift',
            '[1518-11-04 00:36] falls asleep',
            '[1518-11-03 00:24] falls asleep',
            '[1518-11-01 00:55] wakes up',
            '[1518-11-03 00:29] wakes up',
            '[1518-11-04 00:02] Guard #99 begins shift',
            '[1518-11-04 00:46] wakes up',
            '[1518-11-05 00:03] Guard #99 begins shift',
            '[1518-11-05 00:55] wakes up',
        ]);
        $result = $day->getResult(DayInterface::FIRST_PART);

        $this->assertEquals(240, $result[0]);
    }

    public function testPartTwo(): void
    {
        $day = new Day04();
        $day->setData([
            '[1518-11-01 00:00] Guard #10 begins shift',
            '[1518-11-05 00:45] falls asleep',
            '[1518-11-01 23:58] Guard #99 begins shift',
            '[1518-11-01 00:25] wakes up',
            '[1518-11-01 00:30] falls asleep',
            '[1518-11-01 00:05] falls asleep',
            '[1518-11-02 00:40] falls asleep',
            '[1518-11-02 00:50] wakes up',
            '[1518-11-03 00:05] Guard #10 begins shift',
            '[1518-11-04 00:36] falls asleep',
            '[1518-11-03 00:24] falls asleep',
            '[1518-11-01 00:55] wakes up',
            '[1518-11-03 00:29] wakes up',
            '[1518-11-04 00:02] Guard #99 begins shift',
            '[1518-11-04 00:46] wakes up',
            '[1518-11-05 00:03] Guard #99 begins shift',
            '[1518-11-05 00:55] wakes up',
        ]);
        $result = $day->getResult(DayInterface::SECOND_PART);

        $this->assertEquals(4455, $result[0]);
    }
}
