<?php

namespace Lopi\AdventOfCode;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @author Pierre-Louis Launay <laupi.frpar@gmail.com>
 */
class AdventOfCodeCommand extends Command
{
    protected static $defaultName = 'advent-of-code';

    protected function configure()
    {
        $this
            ->setDescription('Execute all advent of code scripts')
            ->addArgument(
                'year',
                InputArgument::REQUIRED,
                'Year of advent of Code'
            )
            ->addArgument(
                'day',
                InputArgument::REQUIRED,
                'Day of advent of Code'
            )
            // ->setHelp('This command allows you to create a user...')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $day = DayFactory::createDay($input->getArgument('day'), $input->getArgument('year'));

        if (!$day) {
            return;
        }

        $output->writeln($day->getDescription());
        $output->writeln('');
        $output->writeln('Result : '.$day->getResult());
    }
}
