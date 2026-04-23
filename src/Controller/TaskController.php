<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Repository\TasksRepository;
#[Route("/tasks")]
class TaskController extends AbstractController
{

    #[Route('', name:"task_home")]
    public function index(): Response
    {
        return $this->render('task/index.html.twig', [
            'controller_name' => 'TaskController',
        ]);
    }

    /**
     * @Route("/task", name="app_task")
     */
    #[Route('', name: "task_list", methods: ['GET'])]
    public function getTasks(TasksRepository $tasksRepository): Response
    {
        $tasks = $tasksRepository->findAll();
        return $this->render('task/list.html.twig', [
            'tasks' => $tasks
       ]);
    }
}
