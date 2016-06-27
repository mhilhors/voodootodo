<?php

namespace AppBundle\Entity;

class TodoItem
{
    /**
     * @var int
     */
    private $id;

    /**
     * The text of the item, reminding the user of what he needs to do.
     *
     * @var string
     */
    private $reminderText;

    /**
     * Whether the user completed the item or not.
     * 
     * @var bool
     */
    private $completed;

    /**
     * Gets the id.
     *
     * @return
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * Gets the reminderText.
     *
     * @return string
     */
    public function getReminderText()
    {
        return $this->reminderText;
    }

    /**
     * Sets the reminderText.
     *
     * @param string reminderText
     * @return $this
     */
    public function setReminderText($reminderText)
    {
        $this->reminderText = $reminderText;
        return $this;
    }

    /**
     * Gets the completion status of the item.
     * 
     * @return bool
     */
    public function isCompleted()
    {
        return $this->completed;
    }

    /**
     * Sets the completion status of the item.
     * 
     * @param bool $completed
     * 
     * @return $this
     */
    public function setCompleted($completed)
    {
        $this->completed = $completed;
        return $this;
    }
}
