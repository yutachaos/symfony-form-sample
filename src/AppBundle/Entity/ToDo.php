<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use AppBundle\Validator\Constraint as Custom;

/**
 * ToDo.
 *
 * @ORM\Table(name="to_do")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ToDoRepository")
 */
class ToDo
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(name="task", type="integer", length=1)
     */
    private $task;

    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Length(min = 2,max = 255)
     * @ORM\Column(name="memo", type="string", length=255, nullable=true)
     */
    private $memo;

    /**
     * @var string
     * @Custom\CheckDateFormat()
     * @ORM\Column(name="date", type="datetime",nullable=false)
     */
    private $date;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="r_datetime", type="datetime", nullable=true)
     */
    private $rDatetime;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="u_datetime", type="datetime", nullable=true)
     */
    private $uDatetime;

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set task.
     *
     * @param string $task
     *
     * @return ToDo
     */
    public function setTask($task)
    {
        $this->task = $task;

        return $this;
    }

    /**
     * Get task.
     *
     * @return string
     */
    public function getTask()
    {
        return $this->task;
    }

    /**
     * Set memo.
     *
     * @param string $memo
     *
     * @return ToDo
     */
    public function setMemo($memo)
    {
        $this->memo = $memo;

        return $this;
    }

    /**
     * Get memo.
     *
     * @return date
     */
    public function getMemo()
    {
        return $this->memo;
    }

    /**
     * @return date
     */
    public function getDate()
    {
        return $this->date;

        return $this;
    }

    /**
     * @param string $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * Set rDatetime.
     *
     * @param \DateTime $rDatetime
     *
     * @return ToDo
     */
    public function setRDatetime($rDatetime)
    {
        $this->rDatetime = $rDatetime;

        return $this;
    }

    /**
     * Get rDatetime.
     *
     * @return \DateTime
     */
    public function getRDatetime()
    {
        return $this->rDatetime;
    }

    /**
     * Set uDatetime.
     *
     * @param \DateTime $uDatetime
     *
     * @return ToDo
     */
    public function setUDatetime($uDatetime)
    {
        $this->uDatetime = $uDatetime;

        return $this;
    }

    /**
     * Get uDatetime.
     *
     * @return \DateTime
     */
    public function getUDatetime()
    {
        return $this->uDatetime;
    }

    /**
     * @ORM\PrePersist
     */
    public function refreshRDatetime()
    {
        $this->setRDatetime(new \Datetime());
    }

    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function refreshUDatetime()
    {
        $this->setUDatetime(new \Datetime());
    }
}
