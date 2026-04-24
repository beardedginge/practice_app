<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PracticeCodeController extends AbstractController
{
    /**
     * @Route("/practice/code", name="app_practice_code")
     */
    public function index(): Response
    {
        return $this->render('practice_code/index.html.twig', [
            'controller_name' => 'PracticeCodeController',
        ]);
    }
}
