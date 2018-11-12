<?php

namespace NetUniversity\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\HttpFoundation\File\UploadedFile;



/**
 * Institut
 *
 * @ORM\Table(name="institut")
 * @ORM\Entity(repositoryClass="NetUniversity\PlatformBundle\Repository\InstitutRepository")
 */
class Institut
{
    /**
   * @ORM\ManyToOne(targetEntity="NetUniversity\PlatformBundle\Entity\Localisation")
   * @ORM\JoinColumn(nullable=false)
   */
    private $localisation;


   /**
   * @ORM\ManyToOne(targetEntity="NetUniversity\PlatformBundle\Entity\University", inversedBy="institut")
   * @ORM\JoinColumn(nullable=false)
   */
      private $university;

    /**
   * @ORM\OneToMany(targetEntity="NetUniversity\PlatformBundle\Entity\Departement", mappedBy="institut")
   * @ORM\JoinColumn(nullable=false)
   */
      private $departement;

    /**
   * @ORM\OneToMany(targetEntity="NetUniversity\PlatformBundle\Entity\Utilisateur", mappedBy="Institut")
   * @ORM\JoinColumn(nullable=false)
   */
      private $utilisateur;

    /**
   * @ORM\OneToOne(targetEntity="NetUniversity\PlatformBundle\Entity\Utilisateur")
   * @ORM\JoinColumn(nullable=false)
   */
      private $owner;


    /**
   * @ORM\OneToMany(targetEntity="NetUniversity\PlatformBundle\Entity\Roles", mappedBy="Institut")
   * @ORM\JoinColumn(nullable=false)
   */
      private $Roles;

    /**
   * @ORM\OneToMany(targetEntity="NetUniversity\PlatformBundle\Entity\Sujet", mappedBy="classe")
   * @ORM\JoinColumn(nullable=false)
   */
      private $sujet;
      
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
     * @var \DateTime
     *
     * @ORM\Column(name="dateCreation", type="datetime")
     */
    private $dateCreation;

    /**
    * @ORM\Column(name="urlIMAGE", type="string", length=255)
    */
    private $urlIMAGE;    

  private $file;
  
  public function getFile()
  {
    return $this->file;
  }

  public function setFile(UploadedFile $file = null)
  {
    $this->file = $file;
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
     * Set nom.
     *
     * @param string $nom
     *
     * @return Institut
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
     * Set localisation.
     *
     * @param \NetUniversity\PlatformBundle\Entity\Localisation $localisation
     *
     * @return Institut
     */
    public function setLocalisation(\NetUniversity\PlatformBundle\Entity\Localisation $localisation)
    {
        $this->localisation = $localisation;

        return $this;
    }

    /**
     * Get localisation.
     *
     * @return \NetUniversity\PlatformBundle\Entity\Localisation
     */
    public function getLocalisation()
    {
        return $this->localisation;
    }

    /**
     * Set university.
     *
     * @param \NetUniversity\PlatformBundle\Entity\University $university
     *
     * @return Institut
     */
    public function setUniversity(\NetUniversity\PlatformBundle\Entity\University $university)
    {
        $this->university = $university;

        return $this;
    }

    /**
     * Get university.
     *
     * @return \NetUniversity\PlatformBundle\Entity\University
     */
    public function getUniversity()
    {
        return $this->university;
    }

    /**
     * Set dateCreation.
     *
     * @param \DateTime $dateCreation
     *
     * @return Institut
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

    /**
     * Set utilisateur.
     *
     * @param \NetUniversity\PlatformBundle\Entity\Utilisateur $utilisateur
     *
     * @return Institut
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

    public function upload()
      {
        // Si jamais il n'y a pas de fichier (champ facultatif), on ne fait rien
        if (null === $this->file) {
          return;
        }

        // On récupère le nom original du fichier de l'internaute
        $name = $this->file->getClientOriginalName();

        // On déplace le fichier envoyé dans le répertoire de notre choix
        $this->file->move($this->getUploadRootDir(), $name);

        // On sauvegarde le nom de fichier dans notre attribut $url
        $this->urlIMAGE = '../uploads/img/'.$name.$this->id;

      }

    public function getUploadDir()
      {
        // On retourne le chemin relatif vers l'image pour un navigateur (relatif au répertoire /web donc)
        return 'uploads/img';
      }

    protected function getUploadRootDir()
      {
        // On retourne le chemin relatif vers l'image pour notre code PHP
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
      }
    

    /**
     * Set urlIMAGE.
     *
     * @param string $urlIMAGE
     *
     * @return Institut
     */
    public function setUrlIMAGE($urlIMAGE)
    {
        $this->urlIMAGE = $urlIMAGE;

        return $this;
    }

    /**
     * Get urlIMAGE.
     *
     * @return string
     */
    public function getUrlIMAGE()
    {
        return $this->urlIMAGE;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->departement = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add departement.
     *
     * @param \NetUniversity\PlatformBundle\Entity\Departement $departement
     *
     * @return Institut
     */
    public function addDepartement(\NetUniversity\PlatformBundle\Entity\Departement $departement)
    {
        $this->departement[] = $departement;

        return $this;
    }

    /**
     * Remove departement.
     *
     * @param \NetUniversity\PlatformBundle\Entity\Departement $departement
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeDepartement(\NetUniversity\PlatformBundle\Entity\Departement $departement)
    {
        return $this->departement->removeElement($departement);
    }

    /**
     * Get departement.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDepartement()
    {
        return $this->departement;
    }

    /**
     * Add utilisateur.
     *
     * @param \NetUniversity\PlatformBundle\Entity\Utilisateur $utilisateur
     *
     * @return Institut
     */
    public function addUtilisateur(\NetUniversity\PlatformBundle\Entity\Utilisateur $utilisateur)
    {
        $this->utilisateur[] = $utilisateur;

        return $this;
    }

    /**
     * Remove utilisateur.
     *
     * @param \NetUniversity\PlatformBundle\Entity\Utilisateur $utilisateur
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeUtilisateur(\NetUniversity\PlatformBundle\Entity\Utilisateur $utilisateur)
    {
        return $this->utilisateur->removeElement($utilisateur);
    }

    /**
     * Add role.
     *
     * @param \NetUniversity\PlatformBundle\Entity\Roles $role
     *
     * @return Institut
     */
    public function addRole(\NetUniversity\PlatformBundle\Entity\Roles $role)
    {
        $this->Roles[] = $role;

        return $this;
    }

    /**
     * Remove role.
     *
     * @param \NetUniversity\PlatformBundle\Entity\Roles $role
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeRole(\NetUniversity\PlatformBundle\Entity\Roles $role)
    {
        return $this->Roles->removeElement($role);
    }

    /**
     * Get roles.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRoles()
    {
        return $this->Roles;
    }

    /**
     * Set owner.
     *
     * @param \NetUniversity\PlatformBundle\Entity\Utilisateur $owner
     *
     * @return Institut
     */
    public function setOwner(\NetUniversity\PlatformBundle\Entity\Utilisateur $owner)
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * Get owner.
     *
     * @return \NetUniversity\PlatformBundle\Entity\Utilisateur
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * Add sujet.
     *
     * @param \NetUniversity\PlatformBundle\Entity\Sujet $sujet
     *
     * @return Institut
     */
    public function addSujet(\NetUniversity\PlatformBundle\Entity\Sujet $sujet)
    {
        $this->sujet[] = $sujet;

        return $this;
    }

    /**
     * Remove sujet.
     *
     * @param \NetUniversity\PlatformBundle\Entity\Sujet $sujet
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeSujet(\NetUniversity\PlatformBundle\Entity\Sujet $sujet)
    {
        return $this->sujet->removeElement($sujet);
    }

    /**
     * Get sujet.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSujet()
    {
        return $this->sujet;
    }
}
