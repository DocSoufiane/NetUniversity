<?php

namespace NetUniversity\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sujet
 *
 * @ORM\Table(name="sujet")
 * @ORM\Entity(repositoryClass="NetUniversity\PlatformBundle\Repository\SujetRepository")
 */
class Sujet
{

          /**
   * @ORM\ManyToOne(targetEntity="NetUniversity\PlatformBundle\Entity\Utilisateur")
   * @ORM\JoinColumn(nullable=false)
   */
    private $utilisateur;
    
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
     * @var string
     *
     * @ORM\Column(name="Detail", type="text")
     */
    private $detail;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DateDeCreation", type="datetime")
     */
    private $dateDeCreation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DateDeModif", type="datetime")
     */
    private $dateDeModif;


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
     * @return Sujet
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
     * Set detail.
     *
     * @param string $detail
     *
     * @return Sujet
     */
    public function setDetail($detail)
    {
        $this->detail = $detail;

        return $this;
    }

    /**
     * Get detail.
     *
     * @return string
     */
    public function getDetail()
    {
        return $this->detail;
    }

    /**
     * Set dateDeCrfeation.
     *
     * @param \DateTime $dateDeCrfeation
     *
     * @return Sujet
     */
    public function setDateDeCrfeation($dateDeCrfeation)
    {
        $this->dateDeCrfeation = $dateDeCrfeation;

        return $this;
    }

    /**
     * Get dateDeCrfeation.
     *
     * @return \DateTime
     */
    public function getDateDeCrfeation()
    {
        return $this->dateDeCrfeation;
    }

    /**
     * Set dateDeModif.
     *
     * @param \DateTime $dateDeModif
     *
     * @return Sujet
     */
    public function setDateDeModif($dateDeModif)
    {
        $this->dateDeModif = $dateDeModif;

        return $this;
    }

    /**
     * Get dateDeModif.
     *
     * @return \DateTime
     */
    public function getDateDeModif()
    {
        return $this->dateDeModif;
    }

    /**
     * Set dateDeCreation.
     *
     * @param \DateTime $dateDeCreation
     *
     * @return Sujet
     */
    public function setDateDeCreation($dateDeCreation)
    {
        $this->dateDeCreation = $dateDeCreation;

        return $this;
    }

    /**
     * Get dateDeCreation.
     *
     * @return \DateTime
     */
    public function getDateDeCreation()
    {
        return $this->dateDeCreation;
    }

    /**
     * Set utilisateur.
     *
     * @param \NetUniversity\PlatformBundle\Entity\Utilisateur $utilisateur
     *
     * @return Sujet
     */
    public function setUtilisateur(\NetUniversity\PlatformBundle\Entity\Utilisateur $utilisateur)
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }

    /**
     * Get utilisateur.
     *
     * @return \NetUniversity\PlatformBundle\Entity\Utilisateur
     */
    public function getUtilisateur()
    {
        return $this->utilisateur;
    }
}
