<?php

declare(strict_types=1);

namespace App\Tests\Service;

use App\Service\FibonacciSequenceCreator;
use PHPUnit\Framework\TestCase;

final class FibonacciSequenceCreatorTest extends TestCase
{
    public function testDummyFibonacciSequenceCreator(): void
    {
        $lowerLimit = 1635724800;
        $upperLimit = 1638316799;

        $fibonacciSequenceCreator = new FibonacciSequenceCreator();
        $fibonacciSequenceCreator->createSequenceFromLimits($lowerLimit, $upperLimit);
        $sequence = $fibonacciSequenceCreator->getSequence();

        $this->assertEquals(
            [
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
            ],
            $sequence
        );
    }
}
