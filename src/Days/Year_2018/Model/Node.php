<?php

namespace Lopi\AdventOfCode\Days\Year_2018\Model;

class Node
{
    /**
     * @var string
     */
    protected $value = null;

    /**
     * @var array
     */
    protected $nextNodes = [];

    /**
     * @var array
     */
    protected $previousNodes = [];

    protected $done = false;

    /**
     * Get the value
     *
     * @return  string
     */ 
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set the value
     *
     * @param  string  $value
     *
     * @return  self
     */ 
    public function setValue(string $value): self
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get the list of nextNodes
     *
     * @return  array
     */ 
    public function getNextNodes(): array
    {
        return $this->nextNodes;
    }

    /**
     * Add next node
     * 
     * @param Node $node
     */
    public function addNextNode(Node $node): self
    {
        $key = $node->getValue() ? $node->getValue() : 'start';
        $this->nextNodes[$key] = $node;
        ksort($this->nextNodes);

        return $this;
    }

    /**
     * Get the list of nextNodes
     *
     * @return  array
     */ 
    public function getPreviousNodes(): array
    {
        return $this->previousNodes;
    }

    /**
     * Add previous node
     * 
     * @param Node $node
     */
    public function addPreviousNode(Node $node): self
    {
        $key = $node->getValue() ? $node->getValue() : 'start';
        $this->previousNodes[$key] = $node;
        ksort($this->previousNodes);

        return $this;
    }

    public function isStart(): bool
    {
        return count($this->previousNodes) === 0;
    }

    public function getSteps()
    {
        $steps = null;
        $keys = array_keys($this->nextNodes);
        var_dump('Available steps '.join(', ', $keys));
        if (0 === count($this->previousNodes)) {
            if (!$this->done) {
                $steps .= $this->getValue();
                $this->done = true;
            }

            foreach ($this->nextNodes as $nextNode) {
                $nextNode->removePreviousNode($this);
            }
        }
        
        foreach ($this->nextNodes as $key => $nextNode) {
            $steps .= $nextNode->getSteps();
        }

        return $steps;
    }

    public function removePreviousNode(Node $node): void
    {
        foreach ($this->previousNodes as $key => $previousNode) {
            if ($previousNode->getValue() === $node->getValue()) {
                unset($this->previousNodes[$key]);
                break;
            }
        }
    }
}
