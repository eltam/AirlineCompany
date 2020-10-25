<?php

namespace App\Entity;

use App\Repository\FlightRepository;
use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\Column(type="string", length=255)
     */
    private $depart_airport;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $arrival_airport;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $aircraft;

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

    public function getDepartAirport(): ?string
    {
        return $this->depart_airport;
    }

    public function setDepartAirport(string $depart_airport): self
    {
        $this->depart_airport = $depart_airport;

        return $this;
    }

    public function getArrivalAirport(): ?string
    {
        return $this->arrival_airport;
    }

    public function setArrivalAirport(string $arrival_airport): self
    {
        $this->arrival_airport = $arrival_airport;

        return $this;
    }

    public function getAircraft(): ?string
    {
        return $this->aircraft;
    }

    public function setAircraft(string $aircraft): self
    {
        $this->aircraft = $aircraft;

        return $this;
    }
}
