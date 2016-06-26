<?php

namespace AppBundle\Entity;

class DoctrineTodoItemRepository extends \Doctrine\ORM\EntityRepository implements TodoItemRepositoryInterface
{
    /**
     * Fetches a list of all TodoItems from the database.
     *
     * @return TodoItem[]
     */
    public function findAll()
    {
        return parent::findAll();
    }
}
