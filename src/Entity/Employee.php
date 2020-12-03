<?php

namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\MappedSuperclass()
 */

class Employee {
    /** @ORM\Column(type="string")
     * @Assert\Regex(pattern="/^\d{15}$/")
     */
    private $num_secu;

    /** @ORM\Column(type="string") */
    private $surname;

    /** @ORM\Column(type="string") */
    private $firstname;

    /** @ORM\Column(type="string") */
    private $street;

    /** @ORM\Column(type="string") */
    private $city;

    /** @ORM\Column(type="string") */
    private $country;

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

    public function getFullname()
    {
        return $this->surname . " " . $this->firstname;
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

    /**
     * @return mixed
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * @param mixed $street
     * @return Employee
     */
    public function setStreet($street)
    {
        $this->street = $street;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param mixed $city
     * @return Employee
     */
    public function setCity($city)
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param mixed $country
     * @return Employee
     */
    public function setCountry($country)
    {
        $this->country = $country;
        return $this;
    }


}