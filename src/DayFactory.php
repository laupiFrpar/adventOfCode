<?php

namespace Lopi\AdventOfCode;

/**
 * @author Pierre-Louis Launay <laupi.frpar@gmail.com>
 */
class DayFactory
{
    /**
     * @param string $day
     * @param string $year
     *
     * @return DayAbstract
     */
    public static function createDay($day, $year)
    {
        if (24 < $day) {
            return null;
        }

        $className = 'Lopi\\AdventOfCode\\Days\\Year_'.$year.'\\Day'.$day;
        $object = null;

        if (class_exists($className)) {
            $object = new $className();
        }

        return $object;
    }
}
