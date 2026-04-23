<?php

namespace App\Entity;

use App\Repository\TasksRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TasksRepository::class)
 */
class Tasks
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    #[ORM\Id]
    #[ORM\GeneratedValue] //auto increment
    #[ORM\Column(type: 'integer')]
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    // private $TaskID;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    #[ORM\Column(type:"datetime", nullable:true)]
    private $DateCompleted;

    /**
     * @ORM\Column(type="string", length=255)
     */
    #[ORM\Column(type:"string")]
    private $Description;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    #[ORM\Column(type:"datetime", nullable:true)]
    private $DueDate;

    /**
     * @ORM\Column(type="string", length=50)
     */
    #[ORM\Column(type:"string", length:50)]
    private $TaskName;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    #[ORM\Column(type:"integer", nullable: true)]
    private $UserID;

    public function getId(): ?int
    {
        return $this->id;
    }

    // public function getTaskID(): ?int
    // {
    //     return $this->TaskID;
    // }

    // public function setTaskID(int $TaskID): self
    // {
    //     $this->TaskID = $TaskID;

    //     return $this;
    // }

    public function getDateCompleted(): ?\DateTimeInterface
    {
        return $this->DateCompleted;
    }

    public function setDateCompleted(?\DateTimeInterface $DateCompleted): self
    {
        $this->DateCompleted = $DateCompleted;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getDueDate(): ?\DateTimeInterface
    {
        return $this->DueDate;
    }

    public function setDueDate(?\DateTimeInterface $DueDate): self
    {
        $this->DueDate = $DueDate;

        return $this;
    }

    public function getTaskName(): ?string
    {
        return $this->TaskName;
    }

    public function setTaskName(string $TaskName): self
    {
        $this->TaskName = $TaskName;

        return $this;
    }

    public function getUserID(): ?int
    {
        return $this->UserID;
    }

    public function setUserID(?int $UserID): self
    {
        $this->UserID = $UserID;

        return $this;
    }
}
