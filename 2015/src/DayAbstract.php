<?php

namespace Lopi\AdventOfCode;

abstract class DayAbstract implements DayInterface
{
    protected $test;
    private $data;

    public function enableTest(bool $test): self
    {
        $this->test = $test;

        return $this;
    }

    protected function getData(): array
    {
        if (!$this->data) {
            $this->data = file($this->getDirectory().'/'.$this->getFilename());
        }

        return $this->data;
    }

    public function setData(array $data): self
    {
        if (!$this->data) {
            $this->data = $data;
        }
        
        return $this;
    }

    protected function getDirectory(): string
    {
        return __DIR__;
    }

    abstract protected function getFilename(): string;
}
