<?php

namespace App\Command;

use App\Service\FibonacciSequenceCreator;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\Input;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:fibonacci:create',
    description: 'Creates a Fibonacci sequence between two numbers.',
    aliases: ['a:p:c'],
)]
class FibonacciCreateCommand extends Command
{
    protected function configure(): void
    {
        $this
            ->addArgument(
                'lowerLimit',
                InputArgument::REQUIRED,
                'Lower limit sequence.'
            )
            ->addArgument(
                'upperLimit',
                InputArgument::REQUIRED,
                'Upper limit sequence.'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $fibonacciSequenceCreator = new FibonacciSequenceCreator(
            $input->getArgument('lowerLimit'),
            $input->getArgument('upperLimit'),
        );
        $fibonacciSequenceCreator->createSequence();

        $io->success($fibonacciSequenceCreator->getSequence());

        return Command::SUCCESS;
    }
}
