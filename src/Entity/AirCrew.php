<?php

namespace App\Entity;

use App\Repository\AirCrewRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AirCrewRepository::class)
 */
class AirCrew extends AirEmployee
{

    const FUNCTION = [
        0 => 'Purser',
        1 => 'Steward',
        2 => 'Attendant',
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
}
