<?php

namespace App\Entity;

use App\Repository\TicketRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TicketRepository::class)
 */
class Ticket
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $issue_date;

    /**
     * @ORM\ManyToOne(targetEntity=Departure::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $departure;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="tickets")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    public function __construct() {
        $this->issue_date = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIssueDate(): ?\DateTimeInterface
    {
        return $this->issue_date;
    }

    public function setIssueDate(\DateTimeInterface $issue_date): self
    {
        $this->issue_date = $issue_date;

        return $this;
    }

    public function getDeparture(): ?Departure
    {
        return $this->departure;
    }

    public function setDeparture(?Departure $departure): self
    {
        $this->departure = $departure;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
