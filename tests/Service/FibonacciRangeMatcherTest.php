<?php

declare(strict_types=1);

namespace App\Tests\Service;

use App\Exception\InvalidDateRangeException;
use App\Exception\InvalidDateRangeFormatException;
use App\Service\FibonacciRangeMatcher;
use PHPUnit\Framework\TestCase;

final class FibonacciRangeMatcherTest extends TestCase
{
    protected FibonacciRangeMatcher $fibonacciRangeMatcher;

    protected function setUp(): void
    {
        $this->fibonacciRangeMatcher = new FibonacciRangeMatcher();
    }

    public function testInvalidDates() {
        $this->expectException(InvalidDateRangeFormatException::class);

        $this->fibonacciRangeMatcher->matchRangeInFibonacciSequence('asdsd', 'asda');
    }

    public function testInvalidRangeDates() {
        $this->expectException(InvalidDateRangeException::class);

        $this->fibonacciRangeMatcher->matchRangeInFibonacciSequence('2021-10-29 00:00:00', '2021-10-28 00:00:00');
    }

    public function testValidRangeDatesWithoutFibonacciMatch() {
        $fibonacciSequenceRangeMatch = $this->fibonacciRangeMatcher->matchRangeInFibonacciSequence('2021-10-29 00:00:00', '2021-10-30 00:00:00');

        $this->assertIsArray($fibonacciSequenceRangeMatch);
        $this->assertEquals(
            [],
            array_values($fibonacciSequenceRangeMatch)
        );
    }

    public function testValidRangeDatesWithStartFibonacciMatch() {
        $fibonacciSequenceRangeMatch = $this->fibonacciRangeMatcher->matchRangeInFibonacciSequence('2004-01-01 00:00:00', '2021-10-30 00:00:00');

        $this->assertIsArray($fibonacciSequenceRangeMatch);
        $this->assertEquals(
            [1134903170],
            array_values($fibonacciSequenceRangeMatch)
        );
    }

    public function testValidRangeDatesWithEndFibonacciMatch() {
        $fibonacciSequenceRangeMatch = $this->fibonacciRangeMatcher->matchRangeInFibonacciSequence('2010-01-01 00:00:00', '2032-12-31 23:59:59');

        $this->assertIsArray($fibonacciSequenceRangeMatch);
        $this->assertEquals(
            [1836311903],
            array_values($fibonacciSequenceRangeMatch)
        );
    }

    public function testValidRangeDatesWithStartAndEndFibonacciMatch() {
        $fibonacciSequenceRangeMatch = $this->fibonacciRangeMatcher->matchRangeInFibonacciSequence('2004-01-01 00:00:00', '2032-12-31 23:59:59');

        $this->assertIsArray($fibonacciSequenceRangeMatch);
        $this->assertEquals(
            [1134903170, 1836311903],
            array_values($fibonacciSequenceRangeMatch)
        );
    }
}
