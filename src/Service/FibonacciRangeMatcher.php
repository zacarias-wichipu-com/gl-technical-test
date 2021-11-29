<?php

declare(strict_types=1);

namespace App\Service;

use App\Exception\InvalidDateRangeException;
use App\Exception\InvalidDateRangeFormatException;

class FibonacciRangeMatcher
{
    private array $fibonacciSequence;
    private int $lowerLimit;
    private int $upperLimit;

    public function matchRangeInFibonacciSequence(
        string $startDate,
        string $endDate
    ):array {
        $this->validateRange($startDate, $endDate);

        $this->createFibonacciSequenceWithUpperLimit($endDate);

        $fibonacciSequenceFiltered = array_filter(
            $this->getFibonacciSequence(),
            function ($fibonacciNumber) {
                return $fibonacciNumber >= $this->lowerLimit && $fibonacciNumber <= $this->upperLimit;
            }
        );

        return $fibonacciSequenceFiltered;
    }

    /**
     * @param int $upperLimit
     * @param int $lowerLimit
     * @throws \Exception
     */
    private function validateRange(string $startDate, string $endDate): void
    {
        if (! ($startDatetimeObject = \DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $startDate))) {
            throw new InvalidDateRangeFormatException("The \"${startDate}\" start date is not a valid date, only the date format \"Y-m-d H:i:s\" are accepted.");
        }

        $startTimestamp = $startDatetimeObject->getTimestamp();

        if (! ($endDatetimeObject = \DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $endDate))) {
            throw new InvalidDateRangeFormatException("The \"${endDate}\" end date is not a valid date, only the date format \"Y-m-d H:i:s\" are accepted.");
        }

        $endTimestamp = $endDatetimeObject->getTimestamp();

        if ($endTimestamp < $startTimestamp) {
            throw new InvalidDateRangeException('The end date must be equal to or greater than the start date.');
        }

        $this->lowerLimit = $startTimestamp;
        $this->upperLimit = $endTimestamp;
    }

    private function createFibonacciSequenceWithUpperLimit(): void
    {
        $this->setFibonacciSequence(range(0, 1));

        while (($theNextFibonacciSequenceElement = $this->theNextFibonacciSequenceElement()) <= $this->upperLimit) {
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