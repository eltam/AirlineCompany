<?php

namespace App\Entity;

use App\Repository\FlightRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToOne;

/**
 * @ORM\Entity(repositoryClass=FlightRepository::class)
 */
class Flight
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $start_validity;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $end_validity;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $depart_day;

    /**
     * @ORM\Column(type="integer")
     */
    private $duration;

    /**
     * @ManyToOne(targetEntity="Airport")
     * @JoinColumn(name="depart_airport_id", referencedColumnName="id")
     */
    private $depart_airport;

    /**
     * @ManyToOne(targetEntity="Airport")
     * @JoinColumn(name="arrival_airport_id", referencedColumnName="id")
     */
    private $arrival_airport;

    /**
     * @ManyToOne(targetEntity="Aircraft")
     */
    private $aircraft;

    /**
     * @ORM\OneToMany(targetEntity=Departure::class, mappedBy="flight")
     */
    private $departures;

    public function __construct()
    {
        $this->departures = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStartValidity(): ?\DateTimeInterface
    {
        return $this->start_validity;
    }

    public function setStartValidity(\DateTimeInterface $start_validity): self
    {
        $this->start_validity = $start_validity;

        return $this;
    }

    public function getEndValidity(): ?\DateTimeInterface
    {
        return $this->end_validity;
    }

    public function setEndValidity(?\DateTimeInterface $end_validity): self
    {
        $this->end_validity = $end_validity;

        return $this;
    }

    public function getDepartDay(): ?string
    {
        return $this->depart_day;
    }

    public function setDepartDay(string $depart_day): self
    {
        $this->depart_day = $depart_day;

        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(int $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDepartAirport()
    {
        return $this->depart_airport;
    }

    /**
     * @param mixed $depart_airport
     * @return Flight
     */
    public function setDepartAirport($depart_airport)
    {
        $this->depart_airport = $depart_airport;
        return $this;
    }

    /**
     * @param mixed $arrival_airport
     * @return Flight
     */
    public function setArrivalAirport($arrival_airport)
    {
        $this->arrival_airport = $arrival_airport;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getArrivalAirport()
    {
        return $this->arrival_airport;
    }

    /**
     * @return mixed
     */
    public function getAircraft()
    {
        return $this->aircraft;
    }

    /**
     * @param mixed $aircraft
     * @return Flight
     */
    public function setAircraft($aircraft)
    {
        $this->aircraft = $aircraft;
        return $this;
    }

    /**
     * @return Collection|Departure[]
     */
    public function getDepartures(): Collection
    {
        return $this->departures;
    }

    public function addDeparture(Departure $departure): self
    {
        if (!$this->departures->contains($departure)) {
            $this->departures[] = $departure;
            $departure->setFlight($this);
        }

        return $this;
    }

    public function removeDeparture(Departure $departure): self
    {
        if ($this->departures->contains($departure)) {
            $this->departures->removeElement($departure);
            // set the owning side to null (unless already changed)
            if ($departure->getFlight() === $this) {
                $departure->setFlight(null);
            }
        }

        return $this;
    }

}
