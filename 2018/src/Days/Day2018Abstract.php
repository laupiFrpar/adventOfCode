<?php

namespace Lopi\AdventOfCode\Days;

use Lopi\AdventOfCode\DayAbstract;

abstract class Day2018Abstract extends DayAbstract
{
    protected function getDirectory(): string
    {
        return parent::getDirectory().'/Days/data';
    }
}
