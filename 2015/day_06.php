<?php

/**
 * See http://adventofcode.com/day/6
 *
 * --- Day 6: Probably a Fire Hazard ---
 *
 * Because your neighbors keep defeating you in the holiday house decorating contest year after year, you've decided to
 * deploy one million lights in a 1000x1000 grid.
 *
 * Furthermore, because you've been especially nice this year, Santa has mailed you instructions on how to display the
 * ideal lighting configuration.
 *
 * Lights in your grid are numbered from 0 to 999 in each direction; the lights at each corner are at 0,0, 0,999,
 * 999,999, and 999,0. The instructions include whether to turn on, turn off, or toggle various inclusive ranges given
 * as coordinate pairs. Each coordinate pair represents opposite corners of a rectangle, inclusive; a coordinate pair
 * like 0,0 through 2,2 therefore refers to 9 lights in a 3x3 square. The lights all start turned off.
 *
 * To defeat your neighbors this year, all you have to do is set up your lights by doing the instructions Santa sent you
 * in order.
 *
 * For example:
 *
 *     - turn on 0,0 through 999,999 would turn on (or leave on) every light.
 *     - toggle 0,0 through 999,0 would toggle the first line of 1000 lights, turning off the ones that were on, and
 *     turning on the ones that were off.
 *     - turn off 499,499 through 500,500 would turn off (or leave off) the middle four lights.
 *
 * After following the instructions, how many lights are lit?
 */

/**
 * Turn on or off the light
 *
 * @param array $lights The lights
 * @param bool  $action The action to light
 * @param int   $startX The start X
 * @param int   $startY The start Y
 * @param int   $endX   The end X
 * @param int   $endY   The end Y
 *
 * @return array
 */
function turn($lights, $action, $startX, $startY, $endX, $endY, $step = 1)
{
    for ($x = $startX; $x <= $endX; $x++) {
        for ($y = $startY; $y <= $endY; $y++) {
            switch ($action) {
                case 'on':
                    $lights[$x][$y] = 1;
                    break;
                case 'off':
                    $lights[$x][$y] = 0;
                    break;
                case 'toggle':
                    $lights[$x][$y] = $lights[$x][$y] === 0 ? 1 : 0;
                    break;
                case 'increase':
                    $lights[$x][$y] += $step;
                    break;
                case 'decrease':
                    if ($lights[$x][$y] > 0) {
                        $lights[$x][$y] -= $step;
                    }
                    break;
            }
        }
    }

    return $lights;
}

/**
 * Count the lit light
 *
 * @param array $lights The lights
 *
 * @return int
 */
function countLights($lights, $lights2)
{
    $totalLit = $totalBrightness = 0;

    for ($x = 0; $x < 1000; $x++) {

        for ($y = 0; $y < 1000; $y++) {
            if ($lights[$x][$y]) {
                $totalLit++;
            }
            $totalBrightness += $lights2[$x][$y];
        }
    }

    return array($totalLit, $totalBrightness);
}

$input = explode("\n", trim(file_get_contents(__DIR__ . '/files/input_06.txt')));
$lights = $lights2 = turn(array(), 'off', 0, 0, 999, 999);

foreach ($input as $instruction) {
    preg_match('/(turn off|turn on|toggle) (\d{1,3}),(\d{1,3}) through (\d{1,3}),(\d{1,3})/', $instruction, $matches);
    list($line, $action, $startX, $startY, $endX, $endY) = $matches;

    switch ($action) {
        case 'turn on':
            $lights = turn($lights, 'on', $startX, $startY, $endX, $endY);
            $lights2 = turn($lights2, 'increase', $startX, $startY, $endX, $endY);
            break;
        case 'turn off':
            $lights = turn($lights, 'off', $startX, $startY, $endX, $endY);
            $lights2 = turn($lights2, 'decrease', $startX, $startY, $endX, $endY);
            break;
        case 'toggle':
            $lights = turn($lights, 'toggle', $startX, $startY, $endX, $endY);
            $lights2 = turn($lights2, 'increase', $startX, $startY, $endX, $endY, 2);
            break;
    }
}

list($lit, $brightness) = countLights($lights, $lights2);
echo sprintf('------ Day 6 ------' . "\r\n");
echo sprintf('See the instruction on http://adventofcode.com/day/6' . "\r\n\r\n");
echo sprintf('--- Part 1 --- ' . "\r\n\r\n");
echo sprintf('%d lights are lit' . "\r\n\r\n", $lit);
echo sprintf('--- Part 2 --- ' . "\r\n\r\n");
echo sprintf('The total brightness of all lights combined is %d' . "\r\n\r\n", $brightness);
