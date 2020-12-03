<?php

namespace App\Entity;

use App\Repository\PilotRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=PilotRepository::class)
 */
class Pilot extends AirEmployee
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Regex(pattern="/^\d{6}$/")
     */
    private $license;

    /**
     * @ORM\OneToMany(targetEntity=Departure::class, mappedBy="pilot")
     */
    private $departures1;

    /**
     * @ORM\OneToMany(targetEntity=Departure::class, mappedBy="copilot")
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

    public function getLicense(): ?string
    {
        return $this->license;
    }

    public function setLicense(string $license): self
    {
        $this->license = $license;

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
            $departure->setPilot($this);
        }

        return $this;
    }

    public function removeDeparture(Departure $departure): self
    {
        if ($this->departures->contains($departure)) {
            $this->departures->removeElement($departure);
            // set the owning side to null (unless already changed)
            if ($departure->getPilot() === $this) {
                $departure->setPilot(null);
            }
        }

        return $this;
    }
}
