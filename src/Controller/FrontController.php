<?php

namespace App\Controller;

use App\Form\FibonacciSequenceType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/', name: 'front_')]
class FrontController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        $form = $this->createForm(FibonacciSequenceType::class);

        return $this->render('front/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
