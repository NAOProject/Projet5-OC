<?php

namespace OC\NAOBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Observation
 *
 * @ORM\Table(name="observation")
 * @ORM\Entity(repositoryClass="OC\NAOBundle\Repository\ObservationRepository")
 */
class Observation
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
  	 *
  	 * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User", inversedBy="observation", cascade={"persist"})
  	 * @ORM\JoinColumn(nullable=false)
  	 *
  	 */
  	private $user;

    /**
     * @ORM\ManyToOne(targetEntity="NAOBundle\Entity\Taxref")
     * @ORM\JoinColumn(name="taxrefname", referencedColumnName="CD_NAME")
     */
    private $taxrefname;

    /**
     * @ORM\OneToOne(targetEntity="NAOBundle\Entity\Picture", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="picture", referencedColumnName="id")
     * @ORM\JoinColumn(nullable=true)
     */
    private $picture;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datetime", type="datetime")
     * @Assert\DateTime()
     */
    private $datetime;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=255, nullable=true)
     * @Assert\NotBlank()
     */
    private $status;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set datetime
     *
     * @param \DateTime $datetime
     *
     * @return Observation
     */
    public function setDatetime($datetime)
    {
        $this->datetime = $datetime;

        return $this;
    }

    /**
     * Get datetime
     *
     * @return \DateTime
     */
    public function getDatetime()
    {
        return $this->datetime;
    }

    /**
     * Set status
     *
     * @param string $status
     *
     * @return Observation
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set user
     *
     * @param \UserBundle\Entity\User $user
     *
     * @return Observation
     */
    public function setUser(\UserBundle\Entity\User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set taxrefname
     *
     * @param \NAOBundle\Entity\Taxref $taxrefname
     *
     * @return Observation
     */
    public function setTaxrefname(\NAOBundle\Entity\Taxref $taxrefname = null)
    {
        $this->taxrefname = $taxrefname;

        return $this;
    }

    /**
     * Get taxrefname
     *
     * @return \NAOBundle\Entity\Taxref
     */
    public function getTaxrefname()
    {
        return $this->taxrefname;
    }

    /**
     * Set picture
     *
     * @param \NAOBundle\Entity\Picture $picture
     *
     * @return Observation
     */
    public function setPicture(\NAOBundle\Entity\Picture $picture = null)
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * Get picture
     *
     * @return \NAOBundle\Entity\Picture
     */
    public function getPicture()
    {
        return $this->picture;
    }
}
