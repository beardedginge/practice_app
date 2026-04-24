<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Repository\TasksRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Tasks; // Make sure this entity exists at src/Entity/Task.php

#[Route("/tasks")]
class TaskController extends AbstractController
{

    #[Route('', name:"task_home")]
    public function index(TasksRepository $tasksRepository): Response
    { 
        $tasks = $tasksRepository->findAll();
        return $this->render('task/index.html.twig', [
            'controller_name' => 'TaskController',
            'tasks' => $tasks
        ]);
    }

    /**
     * @Route("/task", name="app_task")
     */
    #[Route('/gettasks', name: "task_list", methods: ['GET'])]
    public function getTasks(TasksRepository $tasksRepository): Response
    {
        $tasks = $tasksRepository->findAll();
    //     return $this->render('task/list.html.twig', [
    //         'tasks' => $tasks
    //    ]);
        return $this->json($tasks);
    }

    #[Route('/addtasks', name:'task_add', methods: ['POST'])]
    public function addTasks(Request $request, EntityManagerInterface $em): Response{
        $data = json_decode($request->getContent(), true);

        $task = new Tasks();
        $task->setTaskName($data['taskname']);

        $em->persist($task);
        $em->flush();

        return $this->json(['status' => 'ok']);
    }
}
