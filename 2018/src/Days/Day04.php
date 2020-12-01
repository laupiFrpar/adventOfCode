<?php

namespace Lopi\AdventOfCode\Days;

use Lopi\AdventOfCode\DayInterface;

/**
 * @author Pierre-Louis Launay <laupi.frpar@gmail.com>
 */
class Day04 extends Day2018Abstract
{
    const RECORD_PATTERN = '/\[(\d{4}-\d{2}-\d{2}\s+\d{2}:\d{2})\]\s+(.+)/';
    const WAKE_PATTERN = '/wakes up/';
    const BEGIN_PATTERN = '/Guard #(\d+) begins shift/';
    const SLEEP_PATTEN = '/falls asleep/';

    /**
     * [
     *      timestamp => ['minute', 'note']
     * ]
     *
     * planning must be filled from 00:00 to 00:59 only
     */
    private $planning;

    public function getTitle(): string
    {
        return 'Day 4: Repose Record';
    }

    public function getDescription(): string
    {
        return <<<DESCRIPTION
You've sneaked into another supply closet - this time, it's across from the
prototype suit manufacturing lab. You need to sneak inside and fix the issues
with the suit, but there's a guard stationed outside the lab, so this is as
close as you can safely get.

As you search the closet for anything that might help, you discover that you're
not the first person to want to sneak in. Covering the walls, someone has spent
an hour starting every midnight for the past few months secretly observing this
guard post! They've been writing down the ID of the one guard on duty that night
 - the Elves seem to have decided that one guard was enough for the overnight
 shift - as well as when they fall asleep or wake up while at their post (your
 puzzle input).

For example, consider the following records, which have already been organized
into chronological order:

[1518-11-01 00:00] Guard #10 begins shift
[1518-11-01 00:05] falls asleep
[1518-11-01 00:25] wakes up
[1518-11-01 00:30] falls asleep
[1518-11-01 00:55] wakes up
[1518-11-01 23:58] Guard #99 begins shift
[1518-11-02 00:40] falls asleep
[1518-11-02 00:50] wakes up
[1518-11-03 00:05] Guard #10 begins shift
[1518-11-03 00:24] falls asleep
[1518-11-03 00:29] wakes up
[1518-11-04 00:02] Guard #99 begins shift
[1518-11-04 00:36] falls asleep
[1518-11-04 00:46] wakes up
[1518-11-05 00:03] Guard #99 begins shift
[1518-11-05 00:45] falls asleep
[1518-11-05 00:55] wakes up

Timestamps are written using year-month-day hour:minute format. The guard
falling asleep or waking up is always the one whose shift most recently started.
Because all asleep/awake times are during the midnight hour (00:00 - 00:59),
only the minute portion (00 - 59) is relevant for those events.

Visually, these records show that the guards are asleep at these times:

Date   ID   Minute
            000000000011111111112222222222333333333344444444445555555555
            012345678901234567890123456789012345678901234567890123456789
11-01  #10  .....####################.....#########################.....
11-02  #99  ........................................##########..........
11-03  #10  ........................#####...............................
11-04  #99  ....................................##########..............
11-05  #99  .............................................##########.....

The columns are Date, which shows the month-day portion of the relevant day; ID,
which shows the guard on duty that day; and Minute, which shows the minutes
during which the guard was asleep within the midnight hour. (The Minute column's
header shows the minute's ten's digit in the first row and the one's digit in
the second row.) Awake is shown as ., and asleep is shown as #.

Note that guards count as asleep on the minute they fall asleep, and they count
as awake on the minute they wake up. For example, because Guard #10 wakes up at
00:25 on 1518-11-01, minute 25 is marked as awake.

If you can figure out the guard most likely to be asleep at a specific time, you
might be able to trick that guard into working tonight so you can have the best
chance of sneaking in. You have two strategies for choosing the best
guard/minute combination.

Strategy 1: Find the guard that has the most minutes asleep. What minute does
that guard spend asleep the most?

In the example above, Guard #10 spent the most minutes asleep, a total of 50
minutes (20+25+5), while Guard #99 only slept for a total of 30 minutes
(10+10+10). Guard #10 was asleep most during minute 24 (on two days, whereas any
other minute the guard was asleep was only seen on one day).

While this example listed the entries in chronological order, your entries are
in the order you found them. You'll need to organize them before they can be
analyzed.

What is the ID of the guard you chose multiplied by the minute you chose? (In
the above example, the answer would be 10 * 24 = 240.)
DESCRIPTION;
    }

    public function getPartTwoDescription(): string
    {
        return <<<DESCRIPTION
Strategy 2: Of all guards, which guard is most frequently asleep on the same
minute?

In the example above, Guard #99 spent minute 45 asleep more than any other guard
or minute - three times in total. (In all other cases, any guard spent any
minute asleep at most twice.)

What is the ID of the guard you chose multiplied by the minute you chose? (In
the above example, the answer would be 99 * 45 = 4455.)
DESCRIPTION;
    }

    public function getResult(int $part = DayInterface::ALL_PART): array
    {
        $result = [];
        $planning = $this->getPlanning();

        if (DayInterface::ALL_PART === $part || DayInterface::FIRST_PART === $part) {
            $result[] = $this->getMostMinutesSleep($planning);
        }

        if (DayInterface::ALL_PART === $part || DayInterface::SECOND_PART === $part) {
            $result[] = $this->getMostTimeSleep($planning);
        }

        return $result;
    }

    protected function getFilename(): string
    {
        return 'day_04.txt';
    }

    private function getPlanning(): array
    {
        $planning = [];

        foreach ($this->getData() as $line) {
            preg_match(self::RECORD_PATTERN, $line, $matches);
            $planning[] = [
                'datetime' => \DateTime::createFromFormat('Y-m-d H:i', $matches[1]),
                'record' => $matches[2],
            ];
        }

        sort($planning);
        $currentGuard = $sleptMinute = null;
        $guards = [];

        foreach ($planning as $key => $line) {
            if (preg_match(self::BEGIN_PATTERN, $line['record'], $matches)) {
                $currentGuard = $matches[1];

                if (!\array_key_exists($currentGuard, $guards)) {
                    for ($i = 0; $i <= 59; $i++) {
                        $guards[$currentGuard][$i] = 0;
                    }
                }

                $sleptMinute = null;
            } elseif (preg_match(self::SLEEP_PATTEN, $line['record'], $matches)) {
                $sleptMinute = $line['datetime']->format('i');
            } elseif (preg_match(self::WAKE_PATTERN, $line['record'], $matches)) {
                if ($sleptMinute) {
                    for ($i = $sleptMinute; $i < $line['datetime']->format('i'); $i++) {
                        $guards[$currentGuard][(int) $i]++;
                    }
                    $sleptMinute = null;
                }
            }
        }

        return $guards;
    }

    private function getMostMinutesSleep(array $planning): int
    {
        $selectedGuard = null;

        foreach ($planning as $guard => $time) {
            if (!$selectedGuard || ($sumMinutes < array_sum($time))) {
                $selectedGuard = $guard;
                $sumMinutes = array_sum($time);
            }
        }

        $times = $planning[$selectedGuard];
        arsort($times);
        reset($times);
        $selectedMinute = key($times);

        return $selectedGuard*$selectedMinute;
    }

    private function getMostTimeSleep(array $planning): int
    {
        $selectedGuard = $selectedMinute = null;
        $mostSlept = 0;

        foreach ($planning as $guard => $minutes) {
            arsort($minutes);
            reset($minutes);
            $minute = key($minutes);

            if (!$selectedGuard || $minutes[$minute] > $mostSlept) {
                $selectedGuard = $guard;
                $selectedMinute = $minute;
                $mostSlept = $minutes[$minute];
            }
        }

        return $selectedGuard * $selectedMinute;
    }
}
