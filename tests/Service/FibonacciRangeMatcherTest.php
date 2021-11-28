<?php

declare(strict_types=1);

namespace App\Tests\Service;

use App\Service\FibonacciRangeMatcher;
use PHPUnit\Framework\TestCase;

final class FibonacciRangeMatcherTest extends TestCase
{
    protected FibonacciRangeMatcher $fibonacciRangeMatcher;

    protected function setUp(): void
    {
        $this->fibonacciRangeMatcher = new FibonacciRangeMatcher();
    }

    public function testTheTenFirstFibonacciSequenceNumbers(): void {
        $fibonacciSequenceRangeMatch = $this->fibonacciRangeMatcher->matchRangeInFibonacciSequence(0, 34);

        $this->assertEquals(
            [0, 1, 1, 2, 3, 5, 8, 13, 21, 34],
            array_values($fibonacciSequenceRangeMatch)
        );
    }

    public function testTheThirdFirstFibonacciSequenceNumbers(): void {
        $fibonacciSequenceRangeMatch = $this->fibonacciRangeMatcher->matchRangeInFibonacciSequence(0, 1);

        $this->assertEquals(
            [0, 1, 1],
            $fibonacciSequenceRangeMatch
        );
    }

    public function testTheZeroNumberInFibonacciSequenceNumbers(): void {
        $fibonacciSequenceRangeMatch = $this->fibonacciRangeMatcher->matchRangeInFibonacciSequence(0, 0);

        $this->assertEquals(
            [0],
            $fibonacciSequenceRangeMatch
        );
    }

    public function testTheOneNumberInFibonacciSequenceNumbers(): void {
        $fibonacciSequenceRangeMatch = $this->fibonacciRangeMatcher->matchRangeInFibonacciSequence(1, 1);

        $this->assertEquals(
            [1, 1],
            array_values($fibonacciSequenceRangeMatch)
        );
    }

    public function testTheFibonacciSequenceNumbersBetweenFourAndTwentyFive(): void {
        $fibonacciSequenceRangeMatch = $this->fibonacciRangeMatcher->matchRangeInFibonacciSequence(20365011074, 86267571272);

        $this->assertEquals(
            [20365011074, 32951280099, 53316291173, 86267571272],
            array_values($fibonacciSequenceRangeMatch)
        );
    }
    public function testTheFibonacciSequenceNumbersOnTheLimit(): void {
        $fibonacciSequenceRangeMatch = $this->fibonacciRangeMatcher->matchRangeInFibonacciSequence(20365011075, 86267571271);

        $this->assertEquals(
            [32951280099, 53316291173],
            array_values($fibonacciSequenceRangeMatch)
        );
    }
}
