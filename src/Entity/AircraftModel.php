<?php

namespace App\Entity;

use App\Repository\AircraftModelRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\OneToMany;

/**
 * @ORM\Entity(repositoryClass=AircraftModelRepository::class)
 */
class AircraftModel
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     */
    private $capacity;

    /**
     * @ORM\Column(type="integer", options={"default" : 1})
     */
    private $piloting;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCapacity(): ?int
    {
        return $this->capacity;
    }

    public function setCapacity(int $capacity): self
    {
        $this->capacity = $capacity;

        return $this;
    }

    public function getPiloting(): ?int
    {
        return $this->piloting;
    }

    public function setPiloting(int $piloting): self
    {
        $this->piloting = $piloting;

        return $this;
    }
}
