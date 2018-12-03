<?php

namespace Lopi\AdventOfCode;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

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
            ->addOption(
                'description',
                'd',
                InputOption::VALUE_NONE,
                'Show only description'
            )
            ->addOption(
                'result',
                'r',
                InputOption::VALUE_NONE,
                'Show only result'
            )
            ->addOption(
                'test',
                null,
                InputOption::VALUE_NONE,
                'Use data test'
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $day = DayFactory::createDay($input->getArgument('day'), $input->getArgument('year'));
        $day->enableTest($input->getOption('test'));

        if (!$day) {
            return;
        }

        $io = new SymfonyStyle($input, $output);
        $io->title($day->getTitle());

        if ($input->getOption('description') || !$input->getOption('result')) {
            $io->text($day->getDescription());
            $io->section('Part Two');
            $io->text($day->getPartTwoDescription());
        }

        if ($input->getOption('result') || !$input->getOption('description')) {
            $io->section('Result');
            $io->table(
                ['Part One', 'Part Two'],
                [$day->getResult()]
            );
        }
    }
}
