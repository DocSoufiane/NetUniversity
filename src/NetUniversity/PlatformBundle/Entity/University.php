<?php

namespace NetUniversity\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
}
