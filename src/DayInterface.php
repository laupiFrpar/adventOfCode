<?php

namespace Lopi\AdventOfCode;

/**
 * @author Pierre-Louis Launay <laupi.frpar@gmail.com>
 */
interface DayInterface
{
    const ALL_PART = 0;
    const FIRST_PART = 1;
    const SECOND_PART = 2;

    public function getTitle(): string;
    public function getDescription(): string;
    public function getPartTwoDescription(): string;
    public function getResult(int $part): array;
}
