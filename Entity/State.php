<?php

namespace Dacorp\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Dacorp\CoreBundle\Entity\State
 *
 * @ORM\Table(name="dacore_state")
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="Dacorp\CoreBundle\Repository\StateRepository")
 */
class State
{
    /**
     * @var integer $stateId
     *
     * @ORM\Column(name="state_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $stateId;

    /**
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    protected $name;

    /**
     * @var string $country
     *
     * @ORM\Column(name="country", type="string", length=255, nullable=false)
     */
    protected $country;

    /**
     * @var string $code
     *
     * @ORM\Column(name="code", type="string", length=6, nullable=true)
     */
    protected $code;



    /**
     * Get stateId
     *
     * @return integer
     */
    public function getStateId()
    {
        return $this->stateId;
    }

    /**
     * Set name
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set country
     *
     * @param string $country
     */
    public function setCountry($country)
    {
        $this->country = $country;
    }

    /**
     * Get country
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set code
     *
     * @param string $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }
}