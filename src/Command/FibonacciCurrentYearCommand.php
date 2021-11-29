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
    name: 'app:fibonacci:current-year',
    description: 'Search Fibonacci sequence numbers for current year date range.',
    aliases: ['a:f:cy'],
)]
class FibonacciCurrentYearCommand extends Command
{
    protected function configure(): void
    {
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $firstDayOfThisYear = (new \DateTimeImmutable('first day of january this year'))->setTime('00', '00', '00');
        $lastDayOfThisYear = (new \DateTimeImmutable('last day of december this year'))->setTime('23', '59', '59');

        $fibonacciSequenceCreator = new FibonacciRangeMatcher();
        $fibonacciSequenceRangeMatch = $fibonacciSequenceCreator->matchRangeInFibonacciSequence(
            $firstDayOfThisYear->format('Y-m-d H:i:s'),
            $lastDayOfThisYear->format('Y-m-d H:i:s')
        );

        $message = empty($fibonacciSequenceRangeMatch) ? 'No matches have been found in the current year date range ('.$firstDayOfThisYear->format('Y-m-d H:i:s').' to '.$lastDayOfThisYear->format('Y-m-d H:i:s').') with any Fibonacci sequence number.' : 'The following matches with the Fibonacci sequence numbers have been found in the current year date range ('.$firstDayOfThisYear->format('Y-m-d H:i:s').' to '.$lastDayOfThisYear->format('Y-m-d H:i:s').'): ' . join(', ', $fibonacciSequenceRangeMatch);
        $io->info($message);

        return Command::SUCCESS;
    }
}
