<?php

namespace NetUniversity\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Contacts
 *
 * @ORM\Table(name="contacts")
 * @ORM\Entity(repositoryClass="NetUniversity\PlatformBundle\Repository\ContactsRepository")
 */
class Contacts
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
   * @ORM\ManyToOne(targetEntity="NetUniversity\PlatformBundle\Entity\Utilisateur")
   * @ORM\JoinColumn(nullable=false)
   */
    private $Demandeur;

    /**
   * @ORM\ManyToOne(targetEntity="NetUniversity\PlatformBundle\Entity\Utilisateur")
   * @ORM\JoinColumn(nullable=false)
   */
    private $Validateur;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DateDeCreation", type="datetime")
     */
    private $dateDeCreation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DateDeValidation", type="datetime")
     */
    private $dateDeValidation;

    /**
     * @var bool
     *
     * @ORM\Column(name="etat", type="boolean")
     */
    private $etat;


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
     * Set demandeur.
     *
     * @param int $demandeur
     *
     * @return Contacts
     */
   
    /**
     * Set dateDeCreation.
     *
     * @param \DateTime $dateDeCreation
     *
     * @return Contacts
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
     * Set dateDeValidation.
     *
     * @param \DateTime $dateDeValidation
     *
     * @return Contacts
     */
    public function setDateDeValidation($dateDeValidation)
    {
        $this->dateDeValidation = $dateDeValidation;

        return $this;
    }

    /**
     * Get dateDeValidation.
     *
     * @return \DateTime
     */
    public function getDateDeValidation()
    {
        return $this->dateDeValidation;
    }

    /**
     * Set etat.
     *
     * @param bool $etat
     *
     * @return Contacts
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
     * Set demandeur.
     *
     * @param \NetUniversity\PlatformBundle\Entity\Utilisateur $demandeur
     *
     * @return Contacts
     */
    public function setDemandeur(\NetUniversity\PlatformBundle\Entity\Utilisateur $demandeur)
    {
        $this->Demandeur = $demandeur;

        return $this;
    }

    /**
     * Get demandeur.
     *
     * @return \NetUniversity\PlatformBundle\Entity\Utilisateur
     */
    public function getDemandeur()
    {
        return $this->Demandeur;
    }

    /**
     * Set validateur.
     *
     * @param \NetUniversity\PlatformBundle\Entity\Utilisateur $validateur
     *
     * @return Contacts
     */
    public function setValidateur(\NetUniversity\PlatformBundle\Entity\Utilisateur $validateur)
    {
        $this->Validateur = $validateur;

        return $this;
    }

    /**
     * Get validateur.
     *
     * @return \NetUniversity\PlatformBundle\Entity\Utilisateur
     */
    public function getValidateur()
    {
        return $this->Validateur;
    }

    public function validationContact()
    {
        return $this->etat=true;
    }

    public function removeContact()
    {
        return removeElement($this);
    }

    

}
