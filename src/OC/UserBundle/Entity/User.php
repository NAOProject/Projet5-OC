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
   protected $id;


  public function __construct()
  {
      parent::__construct();
       $this->roles = array('ROLE_OBSERVER');
  }

   /**
    * @ORM\OneToMany(targetEntity="OC\NAOBundle\Entity\Observation", mappedBy="user", cascade={"persist"})
    */
    private $observation;


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
