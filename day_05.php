<?php

/**
 * See http://adventofcode.com/day/5
 *
 * --- Day 5: Doesn't He Have Intern-Elves For This? ---
 *
 * Santa needs help figuring out which strings in his text file are naughty or nice.
 *
 * A nice string is one with all of the following properties:
 *
 *     - It contains at least three vowels (aeiou only), like aei, xazegov, or aeiouaeiouaeiou
 *     - It contains at least one letter that appears twice in a row, like xx, abcdde (dd), or aabbccdd (aa, bb, cc, or
 *     dd).
 *     - It does not contain the strings ab, cd, pq, or xy, even if they are part of one of the other requirements.
 *
 * For example:
 *
 *     - ugknbfddgicrmopn is nice because it has at least three vowels (u...i...o...), a double letter (...dd...), and
 *     none of the disallowed substrings.
 *     - aaa is nice because it has at least three vowels and a double letter, even though the letters used by different
 *     rules overlap.
 *     - jchzalrnumimnmhp is naughty because it has no double letter.
 *     - haegwjzuvuyypxyu is naughty because it contains the string xy.
 *     - dvszwmarrgswjxmb is naughty because it contains only one vowel.
 *
 * How many strings are nice?
 *
 * --- Part Two ---
 *
 * Realizing the error of his ways, Santa has switched to a better model of determining whether a string is naughty or
 * nice. None of the old rules apply, as they are all clearly ridiculous.
 *
 * Now, a nice string is one with all of the following properties:
 *
 *     - It contains a pair of any two letters that appears at least twice in the string without overlapping, like xyxy
 *     (xy) or aabcdefgaa (aa), but not like aaa (aa, but it overlaps).
 *     - It contains at least one letter which repeats with exactly one letter between them, like xyx, abcdefeghi (efe),
 *     or even aaa.
 *
 * For example:
 *
 *     - qjhvhtzxzqqjkmpb is nice because is has a pair that appears twice (qj) and a letter that repeats with exactly
 *     one letter between them (zxz).
 *     - xxyxx is nice because it has a pair that appears twice and a letter that repeats with one between, even though
 *     the letters used by each rule overlap.
 *     - uurcxstgmygtbstg is naughty because it has a pair (tg) but no repeat with a single letter between them.
 *     - ieodomkazucvgmuy is naughty because it has a repeating letter with one between (odo), but no pair that appears
 *     twice.
 *
 * How many strings are nice under these new rules?
 */

/**
 * Check the string
 *
 * @param string $string The string to check
 *
 * @return bool
 */
function checkString($string)
{
    $forbiddenCoupleStrings = array('ab', 'cd', 'pq', 'xy');

    foreach ($forbiddenCoupleStrings as $forbiddenCoupleString) {
        if (substr_count($string, $forbiddenCoupleString) > 0) {
            return false;
        }
    }

    $checkLeast3Vowels = $checkOneLetterAppearsTwice = false;
    $vowels = array('a' => 0, 'e' => 0, 'i' => 0, 'o' => 0, 'u' => 0);
    $nextCharacter = null;

    for ($i = 0; $i < strlen($string); $i++) {

        if (!$checkLeast3Vowels && in_array($string[$i], array_keys($vowels))) {
            $vowels[$string[$i]]++;
            $checkLeast3Vowels = (3 === array_sum($vowels));
        }

        if (!$checkOneLetterAppearsTwice && $i < strlen($string) - 1) {
            $checkOneLetterAppearsTwice = ($string[$i] === $string[$i + 1]);
        }
    }

    return $checkLeast3Vowels && $checkOneLetterAppearsTwice;
}

/**
 * New function to check the string
 *
 * @param string $string The string to check
 *
 * @return bool
 */
function checkString2($string)
{
    $lengthString = strlen($string);
    $checkPair2LettersAppearsAtLeastTwice = $checkOneLetterWhichRepeatsWithExactlyOneLetterBetweenThem = false;

    for ($i = 0; $i < $lengthString; $i++) {
        /**
         * If no pair of 2 letters appears at least twice and there is 3 characters, return false because we need 4
         * 4 characters to checkt 2 pairs of 2 letters.
         *
         * If there is 2 characters, return false because no check is valid.
         */
        if ((!$checkPair2LettersAppearsAtLeastTwice && $i === $lengthString - 3) || $i === $lengthString - 2) {
            return false;
        }

        if (!$checkPair2LettersAppearsAtLeastTwice) {
            $pair = $string[$i] . $string[$i + 1];
            $checkPair2LettersAppearsAtLeastTwice = (2 <= substr_count($string, $pair));
        }

        if (!$checkOneLetterWhichRepeatsWithExactlyOneLetterBetweenThem) {
            $pattern = '/' . $string[$i] . '.' . $string[$i] . '/';
            $checkOneLetterWhichRepeatsWithExactlyOneLetterBetweenThem = (1 === preg_match($pattern, $string));
        }

        if ($checkPair2LettersAppearsAtLeastTwice && $checkOneLetterWhichRepeatsWithExactlyOneLetterBetweenThem) {
            return true;
        }
    }
}

$input = explode("\n", trim(file_get_contents(__DIR__ . '/files/input_05.txt')));
$niceStrings = $niceStrings2 = 0;

foreach ($input as $string) {
    if (checkString(strtolower($string))) {
        $niceStrings++;
    }

    if (($result = checkString2(strtolower($string)))) {
        $niceStrings2++;
    }
}

echo sprintf('------ Day 5 ------' . "\r\n");
echo sprintf('See the instruction on http://adventofcode.com/day/5' . "\r\n\r\n");
echo sprintf('--- Part 1 --- ' . "\r\n\r\n");
echo sprintf('%d strings are nice' . "\r\n\r\n", $niceStrings);
echo sprintf('--- Part 2 --- ' . "\r\n\r\n");
echo sprintf('%d strings are nice with the new method' . "\r\n\r\n", $niceStrings2);
