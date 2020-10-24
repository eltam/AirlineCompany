<?php

namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\MappedSuperclass()
 */

class Employee {
    /** @ORM\Column(type="string") */
    private $num_secu;

    /** @ORM\Column(type="string") */
    private $surname;

    /** @ORM\Column(type="string") */
    private $firstname;

    /** @ORM\Column(type="string") */
    private $address;

    /** @ORM\Column(type="integer") */
    private $salary;

    /**
     * @return mixed
     */
    public function getNumSecu()
    {
        return $this->num_secu;
    }

    /**
     * @param mixed $num_secu
     * @return Employee
     */
    public function setNumSecu($num_secu)
    {
        $this->num_secu = $num_secu;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * @param mixed $surname
     * @return Employee
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param mixed $firstname
     * @return Employee
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $address
     * @return Employee
     */
    public function setAddress($address)
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSalary()
    {
        return $this->salary;
    }

    /**
     * @param mixed $salary
     * @return Employee
     */
    public function setSalary($salary)
    {
        $this->salary = $salary;
        return $this;
    }


}