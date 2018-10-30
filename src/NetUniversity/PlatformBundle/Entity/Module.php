<?php

namespace NetUniversity\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Module
 *
 * @ORM\Table(name="module")
 * @ORM\Entity(repositoryClass="NetUniversity\PlatformBundle\Repository\ModuleRepository")
 */
class Module
{


        /**
   * @ORM\ManyToOne(targetEntity="NetUniversity\PlatformBundle\Entity\Utilisateur")
   * @ORM\JoinColumn(nullable=false)
   */
      private $Owner;
      
  /**
   * @ORM\ManyToMany(targetEntity="NetUniversity\PlatformBundle\Entity\Cours", cascade={"persist"}, mappedBy="module")
   * @ORM\JoinTable(name="netuniversity_module_cours")
   */
  private $cours;

  /**
   * @ORM\ManyToMany(targetEntity="NetUniversity\PlatformBundle\Entity\TP", cascade={"persist"})
   */
  private $tp;

    /**
   * @ORM\ManyToMany(targetEntity="NetUniversity\PlatformBundle\Entity\TD", cascade={"persist"})
   */
  private $td;

    /**
   * @ORM\ManyToMany(targetEntity="NetUniversity\PlatformBundle\Entity\Examen", cascade={"persist"})
   */
  private $examen;


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
     * @ORM\Column(name="Nom", type="string", length=255)
     */
    private $nom;

  /**
   * @ORM\ManyToOne(targetEntity="NetUniversity\PlatformBundle\Entity\Filiere", inversedBy="module")
   * @ORM\JoinColumn(nullable=false)
   */
    private $filiere;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCreation", type="datetime")
     */
    private $dateCreation;
    
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
     * Set nom.
     *
     * @param string $nom
     *
     * @return Module
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom.
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }
    /**
     * Constructor
     */
    public function __construct()
    {

        $this->cours = new \Doctrine\Common\Collections\ArrayCollection();
        $this->tp = new \Doctrine\Common\Collections\ArrayCollection();
        $this->td = new \Doctrine\Common\Collections\ArrayCollection();
        $this->examen = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set owner.
     *
     * @param \NetUniversity\PlatformBundle\Entity\Utilisateur $owner
     *
     * @return Module
     */
    public function setOwner(\NetUniversity\PlatformBundle\Entity\Utilisateur $owner)
    {
        $this->Owner = $owner;

        return $this;
    }

    /**
     * Get owner.
     *
     * @return \NetUniversity\PlatformBundle\Entity\Utilisateur
     */
    public function getOwner()
    {
        return $this->Owner;
    }

    /**
     * Add cour.
     *
     * @param \NetUniversity\PlatformBundle\Entity\Cours $cour
     *
     * @return Module
     */
    public function addCour(\NetUniversity\PlatformBundle\Entity\Cours $cour)
    {
        $this->cours[] = $cour;

        return $this;
    }

    /**
     * Remove cour.
     *
     * @param \NetUniversity\PlatformBundle\Entity\Cours $cour
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeCour(\NetUniversity\PlatformBundle\Entity\Cours $cour)
    {
        return $this->cours->removeElement($cour);
    }

    /**
     * Get cours.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCours()
    {
        return $this->cours;
    }

    /**
     * Add tp.
     *
     * @param \NetUniversity\PlatformBundle\Entity\TP $tp
     *
     * @return Module
     */
    public function addTp(\NetUniversity\PlatformBundle\Entity\TP $tp)
    {
        $this->tp[] = $tp;

        return $this;
    }

    /**
     * Remove tp.
     *
     * @param \NetUniversity\PlatformBundle\Entity\TP $tp
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeTp(\NetUniversity\PlatformBundle\Entity\TP $tp)
    {
        return $this->tp->removeElement($tp);
    }

    /**
     * Get tp.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTp()
    {
        return $this->tp;
    }

    /**
     * Add td.
     *
     * @param \NetUniversity\PlatformBundle\Entity\TD $td
     *
     * @return Module
     */
    public function addTd(\NetUniversity\PlatformBundle\Entity\TD $td)
    {
        $this->td[] = $td;

        return $this;
    }

    /**
     * Remove td.
     *
     * @param \NetUniversity\PlatformBundle\Entity\TD $td
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeTd(\NetUniversity\PlatformBundle\Entity\TD $td)
    {
        return $this->td->removeElement($td);
    }

    /**
     * Get td.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTd()
    {
        return $this->td;
    }

    /**
     * Add examan.
     *
     * @param \NetUniversity\PlatformBundle\Entity\Examen $examan
     *
     * @return Module
     */
    public function addExaman(\NetUniversity\PlatformBundle\Entity\Examen $examan)
    {
        $this->examen[] = $examan;

        return $this;
    }

    /**
     * Remove examan.
     *
     * @param \NetUniversity\PlatformBundle\Entity\Examen $examan
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeExaman(\NetUniversity\PlatformBundle\Entity\Examen $examan)
    {
        return $this->examen->removeElement($examan);
    }

    /**
     * Get examen.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getExamen()
    {
        return $this->examen;
    }

    /**
     * Set filiere.
     *
     * @param \NetUniversity\PlatformBundle\Entity\Filiere $filiere
     *
     * @return Module
     */
    public function setFiliere(\NetUniversity\PlatformBundle\Entity\Filiere $filiere)
    {
        $this->filiere = $filiere;

        return $this;
    }

    /**
     * Get filiere.
     *
     * @return \NetUniversity\PlatformBundle\Entity\Filiere
     */
    public function getFiliere()
    {
        return $this->filiere;
    }

    /**
     * Set dateCreation.
     *
     * @param \DateTime $dateCreation
     *
     * @return Module
     */
    public function setDateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    /**
     * Get dateCreation.
     *
     * @return \DateTime
     */
    public function getDateCreation()
    {
        return $this->dateCreation;
    }
}
