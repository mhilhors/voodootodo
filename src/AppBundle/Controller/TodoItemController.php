<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\TodoItem;
use AppBundle\Form\TodoItemType;

/**
 * TodoItem controller.
 *
 * @Route("/todoitem")
 */
class TodoItemController extends Controller
{
    /**
     * Lists all TodoItem entities.
     *
     * @Route("/", name="todoitem_index")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $todoItems = $em->getRepository('AppBundle:TodoItem')->findAll();

        $deleteForms = array();
        foreach ($todoItems as $todoItem)
        {
            $deleteForms[$todoItem->getId()] = $this->createDeleteForm($todoItem)
                ->createView();
        }

        return $this->render('todoitem/index.html.twig', array(
            'todoItems' => $todoItems,
            'delete_forms' => $deleteForms,
            'current_page' => 'todoitem_index',
            'breadcrumb_path' => array(
                array(
                    'path' => $this->generateUrl('todoitem_index'),
                    'title' => 'Things to do',
                ),
            ),
        ));
    }

    /**
     * Creates a new TodoItem entity.
     *
     * @Route("/new", name="todoitem_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $todoItem = new TodoItem();
        $form = $this->createForm('AppBundle\Form\TodoItemType', $todoItem);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($todoItem);
            $em->flush();

            return $this->redirectToRoute('todoitem_index');
        }

        return $this->render('todoitem/new.html.twig', array(
            'todoItem' => $todoItem,
            'form' => $form->createView(),
            'current_page' => 'todoitem_new',
            'breadcrumb_path' => array(
                array(
                    'path' => $this->generateUrl('todoitem_new'),
                    'title' => 'Add a new todo item',
                ),
            ),
        ));
    }

    /**
     * Displays a form to edit an existing TodoItem entity.
     *
     * @Route("/{id}/edit", name="todoitem_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, TodoItem $todoItem)
    {
        $editForm = $this->createForm('AppBundle\Form\TodoItemType', $todoItem);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($todoItem);
            $em->flush();

            return $this->redirectToRoute('todoitem_index');
        }

        return $this->render('todoitem/edit.html.twig', array(
            'todoItem' => $todoItem,
            'edit_form' => $editForm->createView(),
            'breadcrumb_path' => array(
                array(
                    'path' => $this->generateUrl('todoitem_edit', array('id' => $todoItem->getId())),
                    'title' => 'Edit a todo item',
                ),
            ),
        ));
    }

    /**
     * Deletes a TodoItem entity.
     *
     * @Route("/{id}", name="todoitem_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, TodoItem $todoItem)
    {
        $form = $this->createDeleteForm($todoItem);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($todoItem);
            $em->flush();
        }

        return $this->redirectToRoute('todoitem_index');
    }

    /**
     * Creates a form to delete a TodoItem entity.
     *
     * @param TodoItem $todoItem The TodoItem entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(TodoItem $todoItem)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('todoitem_delete', array('id' => $todoItem->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
