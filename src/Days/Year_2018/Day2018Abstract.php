<?php

namespace Lopi\AdventOfCode\Days\Year_2018;

use Lopi\AdventOfCode\DayAbstract;

abstract class Day2018Abstract extends DayAbstract
{
    protected function getDirectory(): string
    {
        return parent::getDirectory().'/Days/Year_2018/data';
    }
}
