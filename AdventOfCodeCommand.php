<?php

namespace Lopi\AdventOfCode;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class AdventOfCodeCommand extends Command
{
    protected static $defaultName = 'advent-of-code';

    protected function configure()
    {
        $this
            // the short description shown while running "php bin/console list"
            ->setDescription('Execute all advent of code scripts')
            // ->setHelp('This command allows you to create a user...')

        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
    }
}
