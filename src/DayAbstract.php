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

    protected function getData()
    {
        if (!$this->data) {
            $this->data = file($this->getDirectory().'/'.$this->getFilename());
        }

        return $this->data;
    }

    protected function getDirectory() :string
    {
        return __DIR__;
    }

    abstract protected function getFilename() :string;
}
