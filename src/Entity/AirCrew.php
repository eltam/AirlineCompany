<?php

namespace App\Entity;

use App\Repository\AirCrewRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AirCrewRepository::class)
 */
class AirCrew extends AirEmployee
{

    const FUNCTION = [
        0 => 'Chef de cabine',
        1 => 'Steward',
        2 => 'Hôtesse',
    ];

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $function;

    /**
     * @ORM\OneToMany(targetEntity=Departure::class, mappedBy="purser")
     */
    private $departures1;

    /**
     * @ORM\OneToMany(targetEntity=Departure::class, mappedBy="crew")
     */
    private $departures2;

    private $departures;

    public function __construct()
    {
        if (isset($this->departures1) and isset($this->departures2)) {
            $this->departures = new ArrayCollection(
                array_merge($this->departures1->toArray(), $this->departures2->toArray())
            );
        }
        else if (isset($this->departures1)) {
            $this->departures = new ArrayCollection($this->departures1->toArray());
        }
        else if (isset($this->departures2)) {
            $this->departures = new ArrayCollection($this->departures2->toArray());
        }
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFunction(): ?string
    {
        return $this->function;
    }

    public function getFunctionName(): ?string
    {
        return self::FUNCTION[$this->function];
    }

    public function setFunction(string $function): self
    {
        $this->function = $function;
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
            $departure->setCrew($this);
        }

        return $this;
    }

    public function removeDeparture(Departure $departure): self
    {
        if ($this->departures->contains($departure)) {
            $this->departures->removeElement($departure);
            // set the owning side to null (unless already changed)
            if ($departure->getCrew() === $this) {
                $departure->setCrew(null);
            }
        }

        return $this;
    }
}
