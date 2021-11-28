<?php

declare(strict_types=1);

namespace App\Service;

final class FibonacciRangeMatcher
{
    private array $fibonacciSequence;

    public function matchRangeInFibonacciSequence(
        int $lowerLimit,
        int $upperLimit
    ):array {
        if ($upperLimit < $lowerLimit) {
            throw new \Exception('The upper limit must be greater or equals than the lower limit.');
        }

        $this->createFibonacciSequenceWithUpperLimit($upperLimit);

        $fibonacciSequenceFiltered = array_filter(
            $this->getFibonacciSequence(),
            function ($fibonacciNumber) use ($lowerLimit, $upperLimit) {
                return $fibonacciNumber >= $lowerLimit && $fibonacciNumber <= $upperLimit;
            }
        );

        return $fibonacciSequenceFiltered;
    }

    private function createFibonacciSequenceWithUpperLimit(
        int $upperLimit
    ): void
    {
        $this->setFibonacciSequence(range(0, 1));

        while (($theNextFibonacciSequenceElement = $this->theNextFibonacciSequenceElement()) <= $upperLimit) {
            $this->setFibonacciSequence([
                ...$this->getFibonacciSequence(),
                ...[$theNextFibonacciSequenceElement]
            ]);
        }
    }

    private function theNextFibonacciSequenceElement()
    {
        list($firstSummand, $seconfSummand) = array_slice($this->getFibonacciSequence(), -2, 2);
        return $firstSummand + $seconfSummand;
    }

    /**
     * @return array
     */
    private function getFibonacciSequence(): array
    {
        return $this->fibonacciSequence;
    }

    /**
     * @param array $fibonacciSequence
     */
    private function setFibonacciSequence(array $fibonacciSequence): void
    {
        $this->fibonacciSequence = $fibonacciSequence;
    }
}