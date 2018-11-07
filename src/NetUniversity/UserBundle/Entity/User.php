<?php

namespace NetUniversity\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

//use FOS\UserBundle\Model\User as BaseUser;

/**
 * @ORM\Table(name="netuniversity_user")
 * @ORM\Entity(repositoryClass="NetUniversity\UserBundle\Entity\UserRepository")
 */
class User //extends BaseUser
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
        // your own logic
    }
}
