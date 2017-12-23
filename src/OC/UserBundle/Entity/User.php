<?php

namespace OC\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use FOS\UserBundle\Model\User as BaseUser;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="OC\UserBundle\Repository\UserRepository")
 */
 class User extends BaseUser
 {
   /**
    * @ORM\Column(name="id", type="integer")
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    */
   private $id;

   /**
    * @ORM\OneToMany(targetEntity="NAOBundle\Entity\Observation", mappedBy="user", cascade={"persist", "remove"})
    */
     private $observation;

   /**
    * @var string
    *
    * @ORM\Column(name="role", type="string", length=20, precision=0, scale=0, nullable=true, unique=false)
    */
   private $role;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->observation = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * Set role
     *
     * @param string $role
     *
     * @return User
     */
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role
     *
     * @return string
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Add observation
     *
     * @param \NAOBundle\Entity\Observation $observation
     *
     * @return User
     */
    public function addObservation(\NAOBundle\Entity\Observation $observation)
    {
        $this->observation[] = $observation;

        return $this;
    }

    /**
     * Remove observation
     *
     * @param \NAOBundle\Entity\Observation $observation
     */
    public function removeObservation(\NAOBundle\Entity\Observation $observation)
    {
        $this->observation->removeElement($observation);
    }

    /**
     * Get observation
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getObservation()
    {
        return $this->observation;
    }
}
