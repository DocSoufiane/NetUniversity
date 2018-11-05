<?php

namespace NetUniversity\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Roles
 *
 * @ORM\Table(name="roles")
 * @ORM\Entity(repositoryClass="NetUniversity\PlatformBundle\Repository\RolesRepository")
 */
class Roles
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
     * @var string
     *
     * @ORM\Column(name="role", type="string", length=255)
     */
    private $role;

    /**
     * @var bool
     *
     * @ORM\Column(name="etat", type="boolean")
     */
    private $etat;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateDAjout", type="datetime")
     */
    private $dateDAjout;

    /**
   * @ORM\ManyToOne(targetEntity="NetUniversity\PlatformBundle\Entity\Institut")
   * @ORM\JoinColumn(nullable=true)
   */
    private $institut;

    /**
   * @ORM\ManyToOne(targetEntity="NetUniversity\PlatformBundle\Entity\Utilisateur", inversedBy="role")
   * @ORM\JoinColumn(nullable=true)
   */
    private $User;

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set role.
     *
     * @param string $role
     *
     * @return Roles
     */
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role.
     *
     * @return string
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set etat.
     *
     * @param bool $etat
     *
     * @return Roles
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * Get etat.
     *
     * @return bool
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * Set dateDAjout.
     *
     * @param \DateTime $dateDAjout
     *
     * @return Roles
     */
    public function setDateDAjout($dateDAjout)
    {
        $this->dateDAjout = $dateDAjout;

        return $this;
    }

    /**
     * Get dateDAjout.
     *
     * @return \DateTime
     */
    public function getDateDAjout()
    {
        return $this->dateDAjout;
    }

    /**
     * Set institut.
     *
     * @param \NetUniversity\PlatformBundle\Entity\Institut|null $institut
     *
     * @return Roles
     */
    public function setInstitut(\NetUniversity\PlatformBundle\Entity\Institut $institut = null)
    {
        $this->institut = $institut;

        return $this;
    }

    /**
     * Get institut.
     *
     * @return \NetUniversity\PlatformBundle\Entity\Institut|null
     */
    public function getInstitut()
    {
        return $this->institut;
    }

    /**
     * Set user.
     *
     * @param \NetUniversity\PlatformBundle\Entity\Utilisateur|null $user
     *
     * @return Roles
     */
    public function setUser(\NetUniversity\PlatformBundle\Entity\Utilisateur $user = null)
    {
        $this->User = $user;

        return $this;
    }

    /**
     * Get user.
     *
     * @return \NetUniversity\PlatformBundle\Entity\Utilisateur|null
     */
    public function getUser()
    {
        return $this->User;
    }
}
