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
  }

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
  
}
