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
        $fibonacciSequenceCreator->createSequenceFromLimits(
            $request->request->get('lower_limit'),
            $request->request->get('upper_limit')
        );

        return $this->json($fibonacciSequenceCreator->getSequence());
    }
}
