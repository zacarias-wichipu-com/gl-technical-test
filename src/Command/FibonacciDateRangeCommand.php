<?php

namespace App\Command;

use App\Service\FibonacciRangeMatcher;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\Input;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:fibonacci:date-range',
    description: 'Search for date range matches in the Fibonacci sequence.',
    aliases: ['a:f:dr'],
)]
class FibonacciDateRangeCommand extends Command
{
    protected function configure(): void
    {
        $this
            ->addArgument(
                'startDate',
                InputArgument::REQUIRED,
                'Start date sequence.'
            )
            ->addArgument(
                'endDate',
                InputArgument::REQUIRED,
                'Start date sequence.'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $fibonacciSequenceCreator = new FibonacciRangeMatcher();
        $fibonacciSequenceRangeMatch = $fibonacciSequenceCreator->matchRangeInFibonacciSequence(
            $input->getArgument('startDate'),
            $input->getArgument('endDate')
        );

        $message = empty($fibonacciSequenceRangeMatch) ? 'No matches have been found in the date range with any Fibonacci sequence number.' : 'The following matches with the Fibonacci sequence numbers have been found: ' . join(', ', $fibonacciSequenceRangeMatch);
        $io->info($message);

        return Command::SUCCESS;
    }
}
