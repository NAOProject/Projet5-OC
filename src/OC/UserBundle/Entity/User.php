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

}
