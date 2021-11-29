<?php

namespace App\Controller\Api;

use App\Exception\InvalidDateRangeException;
use App\Exception\InvalidDateRangeFormatException;
use App\Service\FibonacciRangeMatcher;
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
        FibonacciRangeMatcher $fibonacciRangeMatcher
    ): JsonResponse
    {

        try {
            $fibonacciSequenceRangeMatch = $fibonacciRangeMatcher->matchRangeInFibonacciSequence(
                $request->query->get('start_date'),
                $request->query->get('end_date')
            );
        } catch (InvalidDateRangeFormatException $e) {
            return $this->json([
                'error' => $e->getMessage(),
                Response::HTTP_BAD_REQUEST
            ]);
        } catch (InvalidDateRangeException $e) {
            return $this->json([
                'error' => $e->getMessage(),
                Response::HTTP_BAD_REQUEST
            ]);
        } catch (\Exception $e) {
            return $this->json([
                'error' => $e->getMessage(),
                Response::HTTP_BAD_REQUEST
            ]);
        }

        return $this->json([
            'fibonacci_sequence_range_match' => $fibonacciSequenceRangeMatch
        ]);
    }
}
