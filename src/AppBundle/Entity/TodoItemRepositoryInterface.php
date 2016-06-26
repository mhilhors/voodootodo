<?php

namespace AppBundle\Entity;

interface TodoItemRepositoryInterface 
{
    /**
     * Fetches a list of all TodoItems.
     *
     * @return TodoItem[]
     */
    public function findAll();
}
