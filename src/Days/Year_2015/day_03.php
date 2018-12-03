<?php

/**
 * See http://adventofcode.com/day/3
 *
 * --- Day 3: Perfectly Spherical Houses in a Vacuum ---
 *
 * Santa is delivering presents to an infinite two-dimensional grid of houses.
 *
 * He begins by delivering a present to the house at his starting location, and then an elf at the North Pole calls him
 * via radio and tells him where to move next. Moves are always exactly one house to the north (^), south (v), east (>),
 * or west (<). After each move, he delivers another present to the house at his new location.
 *
 * However, the elf back at the north pole has had a little too much eggnog, and so his directions are a little off, and
 * Santa ends up visiting some houses more than once. How many houses receive at least one present?
 *
 * For example:
 *
 *     - > delivers presents to 2 houses: one at the starting location, and one to the east.
 *     - ^>v< delivers presents to 4 houses in a square, including twice to the house at his starting/ending location.
 *     - ^v^v^v^v^v delivers a bunch of presents to some very lucky children at only 2 houses.
 *
 * --- Part Two ---
 *
 * The next year, to speed up the process, Santa creates a robot version of himself, Robo-Santa, to deliver presents
 * with him.
 *
 * Santa and Robo-Santa start at the same location (delivering two presents to the same starting house), then take turns
 * moving based on instructions from the elf, who is eggnoggedly reading from the same script as the previous year.
 *
 * This year, how many houses receive at least one present?
 *
 * For example:
 *
 *     - ^v delivers presents to 3 houses, because Santa goes north, and then Robo-Santa goes south.
 *     - ^>v< now delivers presents to 3 houses, and Santa and Robo-Santa end up back where they started.
 *     - ^v^v^v^v^v now delivers presents to 11 houses, with Santa going one direction and Robo-Santa going the other.
 */

/**
 * Move the persona in the next house and increment the number of present for this house.
 * If no parameters, we initialize the houses.
 *
 * @param string  $direction The new direction
 * @param integer &$x        The position X of the persona
 * @param integer &$y        The position Y of the persona
 * @param array   $houses    The houses
 *
 * @return array
 */
function move($direction = null, &$x = 0, &$y = 0, array $houses = array()) {
    switch ($direction) {
        case '^':
            $y++;
            break;
        case '>':
            $x++;
            break;
        case 'v':
            $y--;
            break;
        case '<':
            $x--;
            break;
        default:
            break;
    }

    if (!array_key_exists($x, $houses)) {
        $houses[$x] = array();
    }

    if (!array_key_exists($y, $houses[$x])) {
        $houses[$x][$y] = 0;
    }

    $houses[$x][$y]++;

    return $houses;
}

/**
 * Get the total of house received at least one present
 *
 * @param array $houses The houses
 *
 * @return int
 */
function getNumberHouseReceiveAtLeastOnePresent(array $houses) {
    $numberHouseReceiveAtLeastOnePresent = 0;

    foreach ($houses as $housesY) {
        $numberHouseReceiveAtLeastOnePresent += count($housesY);
    }

    return $numberHouseReceiveAtLeastOnePresent;
}

// Use trim to remove the eventual empty last line of the file
$input = trim(file_get_contents(__DIR__ . '/files/input_03.txt'));

// Initialize the array
$houses = move();
$santaX = $santaY =0; // Santa starts at 0,0

/**
 * For each direction, we move the santa in the next house
 */
for ($i = 0; $i < strlen($input); $i++) {
    $houses = move($input[$i], $santaX, $santaY, $houses);
}

echo sprintf('------ Day 3 ------' . "\r\n");
echo sprintf('See the instruction on http://adventofcode.com/day/3' . "\r\n\r\n");
echo sprintf('--- Part 1 --- ' . "\r\n\r\n");
echo sprintf('%d houses receive at least one present ' . "\r\n\r\n", getNumberHouseReceiveAtLeastOnePresent($houses));

// Next year, Reinitialize
$houses = move();
$santaX = $santaY = $roboSantaX = $roboSantaY = 0;

/**
 * All even index, we move the santa in the next house.
 * All odd index, we move the robo santa in the next house.
 */
for ($i = 0; $i < strlen($input); $i++) {
    $houses = (0 === $i % 2) ? move($input[$i], $santaX, $santaY, $houses) : move($input[$i], $roboSantaX, $roboSantaY, $houses);
}

echo sprintf('--- Part 2 --- ' . "\r\n\r\n");
echo sprintf('Next year, %d houses receive at least one present' . "\r\n\r\n", getNumberHouseReceiveAtLeastOnePresent($houses));
