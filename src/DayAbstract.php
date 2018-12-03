<?php

namespace Lopi\AdventOfCode;

abstract class DayAbstract implements DayInterface
{
    protected $test;
    private $data;

    public function enableTest(bool $test)
    {
        $this->test = $test;
    }

    public function getData()
    {
        if (!$this->data) {
            $this->data = file(__DIR__.'/Days/Year_'.$this::YEAR.'/data/day_'.$this::DAY.($this->test ? '_test' : '').'.txt');
        }

        return $this->data;
    }
}
