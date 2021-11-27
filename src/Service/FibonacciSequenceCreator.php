<?php

declare(strict_types=1);

namespace App\Service;

final class FibonacciSequenceCreator
{
    private array $sequence;

    public function __construct(
        private int $lowerLimit,
        private int $upperLimit
    )
    {
    }

    public function createSequence(): void
    {
        $this->setSequence([
            'The',
            'Fibonacci',
            'sequence',
            'between',
            $this->lowerLimit,
            'and',
            $this->upperLimit,
            'is',
            'n',
            '.'
        ]);
    }

    /**
     * @return array
     */
    public function getSequence(): array
    {
        return $this->sequence;
    }

    /**
     * @param array $sequence
     */
    private function setSequence(array $sequence): void
    {
        $this->sequence = $sequence;
    }
}