<?php

namespace NetUniversity\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;



use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Departement
 *
 * @ORM\Table(name="departement")
 * @ORM\Entity(repositoryClass="NetUniversity\PlatformBundle\Repository\DepartementRepository")
 */
class Departement
{

        /**
   * @ORM\ManyToOne(targetEntity="NetUniversity\PlatformBundle\Entity\Utilisateur")
   * @ORM\JoinColumn(nullable=false)
   */
      private $Owner;

    /**
   * @ORM\OneToMany(targetEntity="NetUniversity\PlatformBundle\Entity\Filiere", mappedBy="departement")
   * @ORM\JoinColumn(nullable=false)
   */
      private $filiere;

        /**
   * @ORM\ManyToOne(targetEntity="NetUniversity\PlatformBundle\Entity\Institut", inversedBy="departement")
   * @ORM\JoinColumn(nullable=false)
   */
    private $institut;
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
    * @ORM\Column(name="urlIMAGE", type="string", length=255)
    */
    private $urlIMAGE;  


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
      
  private $file;
  
      /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCreation", type="datetime")
     */
    private $dateCreation;


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
     * @return Departement
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
     * Set institut.
     *
     * @param \NetUniversity\PlatformBundle\Entity\Institut $institut
     *
     * @return Departement
     */
    public function setInstitut(\NetUniversity\PlatformBundle\Entity\Institut $institut)
    {
        $this->institut = $institut;

        return $this;
    }

    /**
     * Get institut.
     *
     * @return \NetUniversity\PlatformBundle\Entity\Institut
     */
    public function getInstitut()
    {
        return $this->institut;
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
     * @return Departement
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
     * Set dateCreation.
     *
     * @param \DateTime $dateCreation
     *
     * @return Departement
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
     * Set owner.
     *
     * @param \NetUniversity\PlatformBundle\Entity\Utilisateur $owner
     *
     * @return Departement
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
     * Constructor
     */
    public function __construct()
    {
        $this->filiere = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add filiere.
     *
     * @param \NetUniversity\PlatformBundle\Entity\Filiere $filiere
     *
     * @return Departement
     */
    public function addFiliere(\NetUniversity\PlatformBundle\Entity\Filiere $filiere)
    {
        $this->filiere[] = $filiere;

        return $this;
    }

    /**
     * Remove filiere.
     *
     * @param \NetUniversity\PlatformBundle\Entity\Filiere $filiere
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeFiliere(\NetUniversity\PlatformBundle\Entity\Filiere $filiere)
    {
        return $this->filiere->removeElement($filiere);
    }

    /**
     * Get filiere.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFiliere()
    {
        return $this->filiere;
    }

    /**
     * Add role.
     *
     * @param \NetUniversity\PlatformBundle\Entity\Roles $role
     *
     * @return Departement
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
     * Add sujet.
     *
     * @param \NetUniversity\PlatformBundle\Entity\Sujet $sujet
     *
     * @return Departement
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
