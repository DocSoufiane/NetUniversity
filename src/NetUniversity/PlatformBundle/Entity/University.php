<?php

namespace NetUniversity\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;

use Symfony\Component\HttpFoundation\File\UploadedFile;
/**
 * University
 *
 * @ORM\Table(name="university")
 * @ORM\Entity(repositoryClass="NetUniversity\PlatformBundle\Repository\UniversityRepository")
 */
class University
{
    /**
   * @ORM\ManyToOne(targetEntity="NetUniversity\PlatformBundle\Entity\Localisation")
   * @ORM\JoinColumn(nullable=false)
   */
    private $localisation;



    /**
   * @ORM\OneToMany(targetEntity="NetUniversity\PlatformBundle\Entity\Utilisateur", mappedBy="University")
   * @ORM\JoinColumn(nullable=false)
   */
      private $utilisateur;

    /**
   * @ORM\OneToOne(targetEntity="NetUniversity\PlatformBundle\Entity\Utilisateur", cascade={"persist"})
   * @ORM\JoinColumn(nullable=true)
   */
      private $owner;

    /**
   * @ORM\OneToMany(targetEntity="NetUniversity\PlatformBundle\Entity\Institut", mappedBy="university")
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @Assert\Choice(choices={"Réel", "Virtuel"}, message="Choose a valid genre. (Réel | Virtuel)")
     * @ORM\Column(name="genre", type="string", length=255)
     */
    private $genre; // reel/ virtuel

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCreation", type="datetime")
     */
    private $dateCreation;

    /**
     * @var \bool
     *
     * @ORM\Column(name="valid", type="bool", options={"default":false})
     */
    private $valid;

    
    /**
    * @ORM\Column(name="urlIMAGE", type="string", length=255)
    */
    private $urlIMAGE;

    /**
     * @Assert\File(
     *     maxSize = "15024k",
     *     mimeTypes = {"image/png", "image/vnd.sealedmedia.softseal.jpg", "video/JPEG"},
     *     mimeTypesMessage = "Tail maximal 15 Mo | type de fichier acceptés (jpeg, jpg, png)"
     * )
     */
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
     * Set name.
     *
     * @param string $name
     *
     * @return University
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set utilisateur.
     *
     * @param \NetUniversity\PlatformBundle\Entity\Utilisateur $utilisateur
     *
     * @return University
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

    /**
     * Set localisation.
     *
     * @param \NetUniversity\PlatformBundle\Entity\Localisation $localisation
     *
     * @return University
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
     * Set dateCreation.
     *
     * @param \DateTime $dateCreation
     *
     * @return University
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
     * @return University
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
        $this->institut = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add institut.
     *
     * @param \NetUniversity\PlatformBundle\Entity\Institut $institut
     *
     * @return University
     */
    public function addInstitut(\NetUniversity\PlatformBundle\Entity\Institut $institut)
    {
        $this->institut[] = $institut;

        return $this;
    }

    /**
     * Remove institut.
     *
     * @param \NetUniversity\PlatformBundle\Entity\Institut $institut
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeInstitut(\NetUniversity\PlatformBundle\Entity\Institut $institut)
    {
        return $this->institut->removeElement($institut);
    }

    /**
     * Get institut.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getInstitut()
    {
        return $this->institut;
    }

    /**
     * Add utilisateur.
     *
     * @param \NetUniversity\PlatformBundle\Entity\Utilisateur $utilisateur
     *
     * @return University
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
     * Set genre.
     *
     * @param string $genre
     *
     * @return University
     */
    public function setGenre($genre)
    {
        $this->genre = $genre;

        return $this;
    }

    /**
     * Get genre.
     *
     * @return string
     */
    public function getGenre()
    {
        return $this->genre;
    }

    /**
     * Set owner.
     *
     * @param \NetUniversity\PlatformBundle\Entity\Utilisateur $owner
     *
     * @return University
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
     * Set valid.
     *
     * @param \bool $valid
     *
     * @return University
     */
    public function setValid(\bool $valid)
    {
        $this->valid = $valid;

        return $this;
    }

    /**
     * Get valid.
     *
     * @return \bool
     */
    public function getValid()
    {
        return $this->valid;
    }
}
