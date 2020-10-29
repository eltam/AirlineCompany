<?php

namespace App\Entity;

use App\Repository\AircraftRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AircraftRepository", repositoryClass=AircraftRepository::class)
 */
class Aircraft
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Regex(pattern="/^\d{10}$/")
     */
    private $registration_number;

    /**
     * @ManyToOne(targetEntity="AircraftModel")
     * @JoinColumn(name="model_id", referencedColumnName="id")
     */
    private $model;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRegistrationNumber(): ?string
    {
        return $this->registration_number;
    }

    public function setRegistrationNumber(string $registration_number): self
    {
        $this->registration_number = $registration_number;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @param mixed $model
     * @return Aircraft
     */
    public function setModel($model)
    {
        $this->model = $model;
        return $this;
    }
}
