<?php

namespace App\Controller;

use App\Service\PracticeCodeService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PracticeCodeController extends AbstractController
{
    /**
     * @Route("/practice/code", name="app_practice_code")
     */
    #[Route("practice",name: "practice_home")]
    public function index(PracticeCodeService $practiceCode): Response
    {
        $ransom = $practiceCode->RansomNote("def", "fedupalready");
        $maxProfit = $practiceCode->MaximumProfit([7, 1, 5, 3, 6, 4]);
        $maxDifferenceBetweenIncreasingElements = $practiceCode->MaxDifferenceBetweenIncreasingElements([1,5,2,10]);
        $removeDuplicates = $practiceCode->RemoveDuplicates([0, 0, 1, 1, 1, 2, 2, 3, 3, 4 ]);

        return $this->render('practice_code/index.html.twig', [
            'controller_name' => 'PracticeCodeController',
            'ransom' => $ransom,
            'maxProfit' => $maxProfit,
            'maxDiff' => $maxDifferenceBetweenIncreasingElements,
            'removeDuplicates' => $removeDuplicates
        ]);
    }
}
