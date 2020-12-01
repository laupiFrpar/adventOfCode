<?php

namespace Lopi\AdventOfCode\Tests\Days;

use Lopi\AdventOfCode\DayInterface;
use Lopi\AdventOfCode\Days\Day07;
use PHPUnit\Framework\TestCase;

final class Day07Test extends TestCase
{
    protected $day;

    protected function setUp()
    {
        $this->day = new Day07();
        $this->day->setData([
            'Step C must be finished before step A can begin.',
            'Step C must be finished before step F can begin.',
            'Step A must be finished before step B can begin.',
            'Step A must be finished before step D can begin.',
            'Step B must be finished before step E can begin.',
            'Step D must be finished before step E can begin.',
            'Step F must be finished before step E can begin.'
        ]);
    }

    public function testPartOne(): void
    {
        $result = $this->day->getResult(DayInterface::FIRST_PART);

        $this->assertEquals('CABDFE', $result[0]);
    }

    public function testPartOne_1(): void
    {
        $this->day->setData([
            'Step G must be finished before step B can begin.',
            'Step C must be finished before step A can begin.',
            'Step C must be finished before step F can begin.',
            'Step A must be finished before step B can begin.',
            'Step G must be finished before step D can begin.',
            'Step A must be finished before step D can begin.',
            'Step B must be finished before step E can begin.',
            'Step D must be finished before step E can begin.',
            'Step F must be finished before step E can begin.'
        ]);

        $result = $this->day->getResult(DayInterface::FIRST_PART);

        $this->assertEquals('CABDFE', $result[0]);
    }

    public function testPartTwo(): void
    {
        $this->markTestSkipped();

        $result = $this->day->getResult(DayInterface::SECOND_PART);

        $this->assertEquals(17, $result[0]);
    }
}
