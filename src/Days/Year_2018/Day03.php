<?php

namespace Lopi\AdventOfCode\Days\Year_2018;

use Lopi\AdventOfCode\DayInterface;

/**
 * @author Pierre-Louis Launay <laupi.frpar@gmail.com>
 */
class Day03 extends Day2018Abstract
{
    const OVERLAP_CLAIM = 'X';
    const NO_CLAIM = '.';

    private $fabric;
    private $intactClaimIds = [];

    public function getTitle(): string
    {
        return 'Day 3: No Matter How You Slice It';
    }

    public function getDescription(): string
    {
        return <<<DESCRIPTION
The Elves managed to locate the chimney-squeeze prototype fabric for Santa's
suit (thanks to someone who helpfully wrote its box IDs on the wall of the
warehouse in the middle of the night). Unfortunately, anomalies are still
affecting them - nobody can even agree on how to cut the fabric.

The whole piece of fabric they're working on is a very large square - at least
1000 inches on each side.

Each Elf has made a claim about which area of fabric would be ideal for Santa's
suit. All claims have an ID and consist of a single rectangle with edges
parallel to the edges of the fabric. Each claim's rectangle is defined as
follows:

    - The number of inches between the left edge of the fabric and the left
    edge of the rectangle.
    - The number of inches between the top edge of the fabric and the top edge
    of the rectangle.
    - The width of the rectangle in inches.
    - The height of the rectangle in inches.

A claim like #123 @ 3,2: 5x4 means that claim ID 123 specifies a rectangle 3
inches from the left edge, 2 inches from the top edge, 5 inches wide, and 4
inches tall. Visually, it claims the square inches of fabric represented by # (
and ignores the square inches of fabric represented by .) in the diagram below:

...........
...........
...#####...
...#####...
...#####...
...#####...
...........
...........
...........

The problem is that many of the claims overlap, causing two or more claims to
cover part of the same areas. For example, consider the following claims:

#1 @ 1,3: 4x4
#2 @ 3,1: 4x4
#3 @ 5,5: 2x2

Visually, these claim the following areas:

........
...2222.
...2222.
.11XX22.
.11XX22.
.111133.
.111133.
........

The four square inches marked with X are claimed by both 1 and 2. (Claim 3,
while adjacent to the others, does not overlap either of them.)

If the Elves all proceed with their own plans, none of them will have enough
fabric. How many square inches of fabric are within two or more claims?
DESCRIPTION;
    }

    public function getPartTwoDescription(): string
    {
        return <<<DESCRIPTION
Amidst the chaos, you notice that exactly one claim doesn't overlap by even a
single square inch of fabric with any other claim. If you can somehow draw
attention to it, maybe the Elves will be able to make Santa's suit after all!

For example, in the claims above, only claim 3 is intact after all claims are
made.

What is the ID of the only claim that doesn't overlap?
DESCRIPTION;
    }

    public function getResult(int $part = DayInterface::ALL_PART): array
    {
        $result = [];
        $this->makeFabric();

        if (DayInterface::ALL_PART === $part || DayInterface::FIRST_PART === $part) {
            $result[] = $this->getTotalOverlapedClaims();
        }

        if (DayInterface::ALL_PART === $part || DayInterface::SECOND_PART === $part) {
            $result[] = join(',', $this->intactClaimIds);
        }

        return $result;
    }

    protected function getFilename(): string
    {
        return 'day_03.txt';
    }

    private function getTotalOverlapedClaims(): int
    {
        $overlapedClaim = 0;

        foreach ($this->fabric as $line) {
            foreach ($line as $square) {
                if ($square === self::OVERLAP_CLAIM) {
                    $overlapedClaim++;
                }
            }
        }

        return $overlapedClaim;
    }

    private function makeFabric(): void
    {
        $this->fillFabric();

        foreach ($this->getData() as $line) {
            if (preg_match('/#(\d+)\s+@\s+(\d+),(\d+):\s+(\d+)x(\d+)/', $line, $matches)) {
                $this->fillFabric($matches[1], $matches[2], $matches[3], $matches[4], $matches[5]);
            }
        }
    }

    private function fillFabric(
        string $content = self::NO_CLAIM,
        int $top = 0,
        int $left = 0,
        int $tall = 1000,
        int $wide = 1000
    ): void {
        $isIntactClaim = true;

        for ($i = $left; $i < ($wide + $left); $i++) {
            for ($j = $top; $j < ($tall + $top); $j++) {
                if (!isset($this->fabric[$i][$j]) || $this->fabric[$i][$j] === self::NO_CLAIM) {
                    $this->fabric[$i][$j] = $content;
                } else {
                    if ($this->fabric[$i][$j] !== self::OVERLAP_CLAIM) {
                        unset($this->intactClaimIds[$this->fabric[$i][$j]]);
                    }

                    $this->fabric[$i][$j] = self::OVERLAP_CLAIM;
                    $isIntactClaim = false;
                }
            }
        }

        if ($isIntactClaim && $content !== self::NO_CLAIM) {
            $this->intactClaimIds[$content] = $content;
        }
    }

    /**
     * Use to debug
     */
    private function showFabric(): void
    {
        echo "\r\n";
        echo "Fabric\r\n\r\n";
        for ($i = 0; $i < count($this->fabric); $i++) {
            for ($j = 0; $j < count($this->fabric[$i]); $j++) {
                echo $this->fabric[$i][$j];
            }
            echo "\r\n";
        }
    }
}
