<?php

namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\MappedSuperclass()
 */

class AirEmployee extends Employee {
    /** @ORM\Column(type="integer") */
    private $flying_hours;

    /**
     * @param mixed $flying_hours
     * @return AirEmployee
     */
    public function setFlyingHours($flying_hours)
    {
        $this->flying_hours = $flying_hours;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFlyingHours()
    {
        return $this->flying_hours;
    }

}