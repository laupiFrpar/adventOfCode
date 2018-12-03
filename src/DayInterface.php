<?php

namespace Lopi\AdventOfCode;

/**
 * @author Pierre-Louis Launay <laupi.frpar@gmail.com>
 */
interface DayInterface
{
    public function getTitle() :string;
    public function getDescription() :string;
    public function getPartTwoDescription() :string;
    public function getResult() :array;
}
