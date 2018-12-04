<?php

namespace Lopi\AdventOfCode\Tests\Days\Year_2018;

use PHPUnit\Framework\TestCase;
use Lopi\AdventOfCode\DayInterface;
use Lopi\AdventOfCode\Days\Year_2018\Day02;

final class Day02Test extends TestCase
{
    public function testPartOne_1(): void
    {
        $day = new Day02();
        $day->setData(['abcdef', 'bababc', 'abbcde', 'abcccd', 'aabcdd', 'abcdee', 'ababab']);
        $result = $day->getResult(DayInterface::FIRST_PART);

        $this->assertEquals(12, $result[0]);
    }

    public function testPartTwo(): void
    {
        $day = new Day02();
        $day->setData(['abcde', 'fghij', 'klmno', 'pqrst', 'fguij', 'axcye', 'wvxyz']);
        $result = $day->getResult(DayInterface::SECOND_PART);

        $this->assertEquals('fgij', $result[0]);
    }
}
