<?php

namespace App\Entity;

use App\Repository\DepartureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DepartureRepository::class)
 */
class Departure
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Flight::class, inversedBy="departures")
     * @ORM\JoinColumn(nullable=false)
     */
    private $flight;

    /**
     * @ORM\Column(type="date")
     */
    private $departure_date;

    /**
     * @ORM\ManyToOne(targetEntity=Pilot::class, inversedBy="departures")
     * @ORM\JoinColumn(nullable=false)
     */
    private $pilot;

    /**
     * @ORM\ManyToOne(targetEntity=Pilot::class)
     */
    private $copilot;

    /**
     * @ORM\ManyToOne(targetEntity=AirCrew::class)
     */
    private $purser;

    /**
     * @ORM\ManyToOne(targetEntity=AirCrew::class)
     */
    private $crew;

    /**
     * @ORM\Column(type="integer")
     */
    private $passengers;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFlight(): ?Flight
    {
        return $this->flight;
    }

    public function setFlight(?Flight $flight): self
    {
        $this->flight = $flight;

        return $this;
    }

    public function getDepartureDate(): ?\DateTimeInterface
    {
        return $this->departure_date;
    }

    public function setDepartureDate(\DateTimeInterface $departure_date): self
    {
        $this->departure_date = $departure_date;

        return $this;
    }

    public function getPilot(): ?Pilot
    {
        return $this->pilot;
    }

    public function setPilot(?Pilot $pilot): self
    {
        $this->pilot = $pilot;

        return $this;
    }

    public function getCopilot(): ?Pilot
    {
        return $this->copilot;
    }

    public function setCopilot(?Pilot $copilot): self
    {
        $this->copilot = $copilot;

        return $this;
    }

    public function getPassengers(): ?int
    {
        return $this->passengers;
    }

    public function setPassengers(int $passengers): self
    {
        $this->passengers = $passengers;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPurser()
    {
        return $this->purser;
    }

    /**
     * @param mixed $purser
     * @return Departure
     */
    public function setPurser($purser)
    {
        $this->purser = $purser;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCrew()
    {
        return $this->crew;
    }

    /**
     * @param mixed $crew
     * @return Departure
     */
    public function setCrew($crew)
    {
        $this->crew = $crew;
        return $this;
    }
}