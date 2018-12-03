<?php

/**
 * See http://adventofcode.com/day/4
 *
 * --- Day 4: The Ideal Stocking Stuffer ---
 *
 * Santa needs help mining some AdventCoins (very similar to bitcoins) to use as gifts for all the economically
 * forward-thinking little girls and boys.
 *
 * To do this, he needs to find MD5 hashes which, in hexadecimal, start with at least five zeroes. The input to the MD5
 * hash is some secret key (your puzzle input, given below) followed by a number in decimal. To mine AdventCoins, you
 * must find Santa the lowest positive number (no leading zeroes: 1, 2, 3, ...) that produces such a hash.
 *
 * For example:
 *
 *     - If your secret key is abcdef, the answer is 609043, because the MD5 hash of abcdef609043 starts with five
 *     zeroes (000001dbbfa...), and it is the lowest such number to do so.
 *     - If your secret key is pqrstuv, the lowest number it combines with to make an MD5 hash starting with five zeroes
 *     is 1048970; that is, the MD5 hash of pqrstuv1048970 looks like 000006136ef....
 *
 * --- Part Two ---
 *
 * Now find one that starts with six zeroes.
 */

/**
 * Find the lowest positive number that produces a hash starting with the value of the parameter hashStartingWith
 *
 * @param string $secretKey        The secret key
 * @param string $hashStartingWith The value of the start of the hash
 *
 * @return int
 */
function findLowestPositiveNumberThatProducesHashStartingWith($secretKey, $hashStartingWith)
{
    for ($number = 1; ; $number++) {
        $result = md5($secretKey . $number);

        if (0 === strpos($result, '00000')) {
            break;
        }
    }

    return $result;
}
// The secret key
$secretKey = 'ckczppom';

echo sprintf('------ Day 4 ------' . "\r\n");
echo sprintf('See the instruction on http://adventofcode.com/day/4' . "\r\n\r\n");
echo sprintf('--- Part 1 --- ' . "\r\n\r\n");
echo sprintf('The number which produces the hash starting with 5 zeros is %d' . "\r\n\r\n", findLowestPositiveNumberThatProducesHashStartingWith($secretKey, '00000'));
echo sprintf('--- Part 2 --- ' . "\r\n\r\n");
echo sprintf('The number which produces the hash starting with 6 zeros is %d' . "\r\n\r\n", findLowestPositiveNumberThatProducesHashStartingWith($secretKey, '000000'));
