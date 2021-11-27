<?php

declare(strict_types=1);

namespace App\Service;

final class FibonacciSequenceCreator
{
    private array $sequence;

    public function createSequenceFromLimits(
        int $lowerLimit,
        int $upperLimit

    ): void
    {
        if ($upperLimit <= $lowerLimit) {
            throw new \Exception('The upper limit must be greater than the lower limit.');
        }

        $this->setSequence([
            'The',
            'Fibonacci',
            'sequence',
            'between',
            $lowerLimit,
            'and',
            $upperLimit,
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