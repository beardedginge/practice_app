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
        $sortGrades = $practiceCode->SortGrades([80, 90, 30, 4, 50, 70, 20]);
        $palindromeNumber = $practiceCode->PalindromeNumber(343);
        $test2 = [
            'project' => 'Website',
            'meta' => [
                'created' => '2026-01-01',
                'tags' => ['php', 'symfony']
            ],
            'data' => [
                [
                    'title' => 'Task A',
                    'completed' => true
                ],
                [
                    'label' => 'Task B',
                    'items' => [
                        ['foo' => 'bar'],
                        ['baz' => [1, 2, 3]]
                    ]
                ]
            ]
        ];

        $tree = [
            [
                'id' => 1,
                'name' => 'Task A',
                'completed' => true,
                'subtasks' => [
                    [
                        'id' => 2,
                        'name' => 'Task B',
                        'completed' => false
                    ],
                    [
                        'id' => 3,
                        'name' => 'Task C',
                        'completed' => true,
                        'subtasks' => [
                        [
                            'id' => 5,
                            'name' => 'Task Test',
                            'completed' => true
                        ]
                        ]
                    ]
                ]
            ],
            [
                'id' => 4,
                'name' => 'Task D',
                'completed' => true
            ]
        ];

        $orders = [
            [
                "id" => 1,
                "customer" => "Alice",
                "items" => [
                    ["name" => "Laptop", "price" => 1000, "quantity" => 1],
                    ["name" => "Mouse", "price" => 50, "quantity" => 2],
                ]
            ],
            [
                "id" => 2,
                "customer" => "Bob",
                "items" => [
                    ["name" => "Keyboard", "price" => 80, "quantity" => 1],
                ]
            ],
            [
                "id" => 3,
                "customer" => "Alice",
                "items" => []
            ]
        ];

        // $apiResponse = [
        //     "data" => [
        //         [
        //             "user_id" => 1,
        //             "first_name" => "Alice",
        //             "last_name" => "Brown",
        //             "orders" => 3
        //         ],
        //         [
        //             "user_id" => 2,
        //             "first_name" => "Bob",
        //             "last_name" => "Smith",
        //             "orders" => 1
        //         ]
        //     ]
        // ];

        $apiResponse = [
            "users" => [
                [
                    "id" => 1,
                    "first_name" => "Alice",
                    "last_name" => "Brown",
                    "orders" => [
                        ["amount" => 100],
                        ["amount" => 200]
                    ]
                ],
                [
                    "id" => 2,
                    "first_name" => "Bob",
                    "last_name" => "Smith",
                    "orders" => [
                        ["amount" => 50]
                    ]
                ],
                [
                    "id" => 3,
                    "first_name" => "Charlie",
                    "last_name" => "Jones",
                    "orders" => []
                ]
            ]
        ];

        $treeTraversal = $practiceCode->TreeTraversal($tree); 
        // dd($practiceCode->APIChallenge2($apiResponse));
        return $this->render('practice_code/index.html.twig', [
            'controller_name' => 'PracticeCodeController',
            'ransom' => $ransom,
            'maxProfit' => $maxProfit,
            'maxDiff' => $maxDifferenceBetweenIncreasingElements,
            'removeDuplicates' => $removeDuplicates,
            'sortGrades' => implode(',', $sortGrades),
            'palindromeNum' => $palindromeNumber,
            //'treeArray' => ''//implode(',',$treeTraversal),
            'treeArray' => $treeTraversal,
            'orders' => $practiceCode->TotalByCustomerArray($orders),
            'apiResponse' => $practiceCode->APIChallenge2($apiResponse)
        ]);
    }
}
