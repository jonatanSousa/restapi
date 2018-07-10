<?php
/**
 * Created by PhpStorm.
 * User: Nearshore Portugal
 * Date: 4/20/2018
 * Time: 3:24 PM
 */

namespace Entity;


class Task
{
    /**
     * @var text
     */
    protected $task;

    /**
     * @var date
     */
    protected $dueDate;

    /**
     * @return mixed
     */
    public function getTask()
    {
        return $this->task;
    }

    /**
     * @param $task
     */
    public function setTask($task)
    {
        $this->task = $task;
    }

    /**
     * @return mixed
     */
    public function getDueDate()
    {
        return $this->dueDate;
    }

    /**
     * @param \DateTime|null $dueDate
     */
    public function setDueDate(\DateTime $dueDate = null)
    {
        $this->dueDate = $dueDate;
    }

}