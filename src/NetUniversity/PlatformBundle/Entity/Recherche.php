<?php

namespace NetUniversity\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Recherche
 *
 * @ORM\Table(name="recherche")
 * @ORM\Entity(repositoryClass="NetUniversity\PlatformBundle\Repository\RechercheRepository")
 */
class Recherche
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
     * @ORM\Column(name="MotCle", type="text")
     */
    private $MotCle;

  //private $recherche;
  
      /**
    * @ORM\OneToOne(targetEntity="NetUniversity\PlatformBundle\Entity\Cours", inversedBy="recherche")
    */
    private $cours;

  public function getRecherche()
  {
    return $this->recherche;
  }

  public function setRecherche( $recherchee = null)
  {
    $this->recherche = $recherche;
  }

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
     * Set motCle.
     *
     * @param string $motCle
     *
     * @return Recherche
     */
    public function setMotCle($motCle)
    {
        $this->MotCle = $motCle;

        return $this;
    }

    /**
     * Get motCle.
     *
     * @return string
     */
    public function getMotCle()
    {
        return $this->MotCle;
    }


    /**
     * Set cours.
     *
     * @param \NetUniversity\PlatformBundle\Entity\Cours|null $cours
     *
     * @return Recherche
     */
    public function setCours(\OC\PlatformBundle\Entity\Cours $cours = null)
    {
        $this->cours = $cours;

        return $this;
    }

    /**
     * Get cours.
     *
     * @return \NetUniversity\PlatformBundle\Entity\Cours|null
     */
    public function getCours()
    {
        return $this->cours;
    }
}
