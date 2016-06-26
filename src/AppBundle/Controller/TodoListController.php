<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\TodoItemRepositoryInterface;

class TodoListController extends Controller
{
    /**
     * Renders a list of to do items with a some buttons for crud operations.
     *
     * @Route("/", name="Todo list")
     */
    public function indexAction()
    {
        $todoItemRepository = $this->container->get('todoItemRepository');
        $items = $todoItemRepository->findAll();

        // replace this example code with whatever you need
        return $this->render('todoList/index.html.twig', [
            'todoItems' => $items,
        ]);
    }
}
