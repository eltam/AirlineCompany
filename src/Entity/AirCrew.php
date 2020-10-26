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
     * @ORM\ManyToMany(targetEntity=Departure::class, mappedBy="crew")
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

    public function getFunction(): ?string
    {
        return $this->function;
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
            $departure->addCrew($this);
        }

        return $this;
    }

    public function removeDeparture(Departure $departure): self
    {
        if ($this->departures->contains($departure)) {
            $this->departures->removeElement($departure);
            $departure->removeCrew($this);
        }

        return $this;
    }
}
