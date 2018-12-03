<?php

/**
 * See http://adventofcode.com/day/7
 *
 * --- Day 7: Some Assembly Required ---
 *
 * This year, Santa brought little Bobby Tables a set of wires and bitwise logic gates! Unfortunately, little Bobby is a
 * little under the recommended age range, and he needs help assembling the circuit.
 *
 * Each wire has an identifier (some lowercase letters) and can carry a 16-bit signal (a number from 0 to 65535). A
 * signal is provided to each wire by a gate, another wire, or some specific value. Each wire can only get a signal from
 * one source, but can provide its signal to multiple destinations. A gate provides no signal until all of its inputs
 * have a signal.
 *
 * The included instructions booklet describes how to connect the parts together: x AND y -> z means to connect wires x
 * and y to an AND gate, and then connect its output to wire z.
 *
 * For example:
 *
 *     - 123 -> x means that the signal 123 is provided to wire x.
 *     - x AND y -> z means that the bitwise AND of wire x and wire y is provided to wire z.
 *     - p LSHIFT 2 -> q means that the value from wire p is left-shifted by 2 and then provided to wire q.
 *     - NOT e -> f means that the bitwise complement of the value from wire e is provided to wire f.
 *
 * Other possible gates include OR (bitwise OR) and RSHIFT (right-shift). If, for some reason, you'd like to emulate the
 * circuit instead, almost all programming languages (for example, C, JavaScript, or Python) provide operators for these
 * gates.
 *
 * For example, here is a simple circuit:
 *
 *     - 123 -> x
 *     - 456 -> y
 *     - x AND y -> d
 *     - x OR y -> e
 *     - x LSHIFT 2 -> f
 *     - y RSHIFT 2 -> g
 *     - NOT x -> h
 *     - NOT y -> i
 *
 * After it is run, these are the signals on the wires:
 *
 *     - d: 72
 *     - e: 507
 *     - f: 492
 *     - g: 114
 *     - h: 65412
 *     - i: 65079
 *     - x: 123
 *     - y: 456
 *
 * In little Bobby's kit's instructions booklet (provided as your puzzle input), what signal is ultimately provided to
 * wire a?
 */

function resolveWire($index, &$wire)
{
    if (null !== $wire[$index]['result']) {
        return $wire[$index]['result'];
    }

    $leftArgument = $wire[$index]['leftArgument'];

    if (null !== $leftArgument && !is_numeric($leftArgument)) {
        $leftArgument = resolveWire($leftArgument, $wire);
    }

    $rightArgument = $wire[$index]['rightArgument'];

    if (null !== $rightArgument && !is_numeric($rightArgument)) {
        $rightArgument = resolveWire($rightArgument, $wire);
    }

    switch ($wire[$index]['operator']) {
        case 'NOT':
            $wire[$index]['result'] = ~ (int) $leftArgument;
            break;
        case 'AND':
            $wire[$index]['result'] = (int) $leftArgument & (int) $rightArgument;
            break;
        case 'OR':
            $wire[$index]['result'] = (int) $leftArgument | (int) $rightArgument;
            break;
        case 'LSHIFT':
            $wire[$index]['result'] = (int) $leftArgument << (int) $rightArgument;
            break;
        case 'RSHIFT':
            $wire[$index]['result'] = (int) $leftArgument >> (int) $rightArgument;
            break;
        default:
            $wire[$index]['result'] = $leftArgument;
    }

    return $wire[$index]['result'];
}

$input = explode("\n", trim(file_get_contents(__DIR__ . '/files/input_07.txt')));
$wire = array();

foreach ($input as $line) {
    preg_match('/((NOT)\s*)?([a-z\d]+)\s*((AND|OR|[LR]SHIFT)\s*([a-z\d]+)\s*)?->\s*([a-z\d]+)/', $line, $instructions);
    $wire[$instructions[7]] = array(
        'leftArgument' => $instructions[3] === '' ? null : $instructions[3],
        'operator' => $instructions[2] === '' ? ($instructions[5] === '' ? null : $instructions[5]) : $instructions[2],
        'rightArgument' => $instructions[6] === '' ? null : $instructions[6],
        'result' => null,
    );
}

$wire2 = $wire;

echo sprintf('------ Day 7 ------' . "\r\n");
echo sprintf('See the instruction on http://adventofcode.com/day/7' . "\r\n\r\n");
echo sprintf('--- Part 1 --- ' . "\r\n\r\n");
echo sprintf('The signal "%d" is ultimately provided to wire a.' . "\r\n\r\n", resolveWire('a', $wire));
echo sprintf('--- Part 2 --- ' . "\r\n\r\n");
$wire2['b']['result'] = $wire['a']['result'];
echo sprintf('The signal "%d" is ultimately provided to wire a.' . "\r\n\r\n", resolveWire('a', $wire2));
