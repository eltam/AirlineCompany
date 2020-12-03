<?php

namespace App\Entity;

use App\Repository\DepartureRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @Assert\IsTrue(message = "Le pilote et le copilote ne peuvent pas être la même personne")
     */
    public function isPilotEqualCopilot()
    {
        return $this->getPilot()->getId() != $this->getCopilot()->getId();
    }
    /**
     * @ORM\ManyToOne(targetEntity=Pilot::class, inversedBy="departures1")
     * @ORM\JoinColumn(nullable=false)
     */
    private $pilot;

    /**
     * @ORM\ManyToOne(targetEntity=Pilot::class, inversedBy="departures2")
     * @ORM\JoinColumn(nullable=false)
     */
    private $copilot;

    /**
     * @Assert\IsTrue(message = "Le chef de cabine et l'assistant de cabine ne peuvent pas être la même personne")
     */
    public function isPurserEqualCrew()
    {
        return $this->getPurser()->getId() != $this->getCrew()->getId();
    }
    /**
     * @ORM\ManyToOne(targetEntity=AirCrew::class, inversedBy="departures1")
     * @ORM\JoinColumn(nullable=false)
     */
    private $purser;

    /**
     * @ORM\ManyToOne(targetEntity=AirCrew::class, inversedBy="departures2")
     * @ORM\JoinColumn(nullable=false)
     */
    private $crew;

    /**
     * @ORM\Column(type="integer")
     */
    private $passengers;

    /**
     * @ORM\Column(type="integer")
     */
    private $price;

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

    public function addOnePassenger(): self
    {
        $this->passengers += 1;

        return $this;
    }

    public function getAvailablePlaces(): ?int
    {
        return $this->flight->getAircraft()->getModel()->getCapacity() - $this->passengers;
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

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getArrivalDate(): ?\DateTimeInterface
    {
        $total_time = (int) ($this->flight->getDepartTime()->format('H')) + $this->flight->getDuration();
        $extra_days = (int) ($total_time / 24);
        return $this->departure_date->modify('+'.$extra_days.' days');
    }
}
