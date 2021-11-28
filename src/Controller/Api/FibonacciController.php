<?php

namespace App\Controller\Api;

use App\Service\FibonacciSequenceCreator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/fibonacci', name: 'api_fibonacci_')]
class FibonacciController extends AbstractController
{
    #[Route(
        '/',
        name: 'get',
        methods: ['GET', 'POST']
    )]
    public function index(
        Request $request,
        FibonacciSequenceCreator $fibonacciSequenceCreator
    ): JsonResponse
    {

        $lowerLimitDate = \DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $request->query->get('lower_limit'));
        $upperLimitDate = \DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $request->query->get('upper_limit'));

        $fibonacciSequenceCreator->createSequenceFromLimits(
            $lowerLimitDate->getTimestamp(),
            $upperLimitDate->getTimestamp()
        );

        return $this->json([
            'contained_numbers' => $fibonacciSequenceCreator->getSequence()
        ]);
    }
}
