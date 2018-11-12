<?php

namespace NetUniversity\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;


/**
 * Chate
 *
 * @ORM\Table(name="chate")
 * @ORM\Entity(repositoryClass="NetUniversity\PlatformBundle\Repository\ChateRepository")
 */
class Chate
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
    private $emeteur;

    /**
   * @ORM\ManyToOne(targetEntity="NetUniversity\PlatformBundle\Entity\Utilisateur")
   * @ORM\JoinColumn(nullable=false)
   */
    private $recepteur;


    /**
     * @var string
     *
     * @ORM\Column(name="Fichier", type="string", length=255, nullable=true)
     */
    private $Fichier;    

   
    /**
     * @var text
     *
     * @ORM\Column(name="message", type="text", nullable=true)
     */
    private $message;


    /**
    * @ORM\Column(name="DateDeCreation", type="datetime")
    */
    private $Date;


    /**
     * @Assert\File(
     *     maxSize = "15024k",
     *     mimeTypes = {"application/pdf", "application/x-pdf", "application/vnd.comicbook-rar", "application/vnd.comicbook+zip", "image/png", "image/vnd.sealedmedia.softseal.jpg", "video/JPEG"},
     *     mimeTypesMessage = "Tail maximal 15 Mo | type de fichier acceptés (PDF, zip, rar, jpeg, jpg, png)"
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
     * Set fichier.
     *
     * @param string|null $fichier
     *
     * @return Chate
     */
    public function setFichier($fichier = null)
    {
        $this->Fichier = $fichier;

        return $this;
    }

    /**
     * Get fichier.
     *
     * @return string|null
     */
    public function getFichier()
    {
        return $this->Fichier;
    }

    /**
     * Set message.
     *
     * @param string|null $message
     *
     * @return Chate
     */
    public function setMessage($message = null)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message.
     *
     * @return string|null
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set date.
     *
     * @param \DateTime $date
     *
     * @return Chate
     */
    public function setDate($date)
    {
        $this->Date = $date;

        return $this;
    }

    /**
     * Get date.
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->Date;
    }

    /**
     * Set emeteur.
     *
     * @param \NetUniversity\PlatformBundle\Entity\Utilisateur $emeteur
     *
     * @return Chate
     */
    public function setEmeteur(\NetUniversity\PlatformBundle\Entity\Utilisateur $emeteur)
    {
        $this->emeteur = $emeteur;

        return $this;
    }

    /**
     * Get emeteur.
     *
     * @return \NetUniversity\PlatformBundle\Entity\Utilisateur
     */
    public function getEmeteur()
    {
        return $this->emeteur;
    }

    /**
     * Set recepteur.
     *
     * @param \NetUniversity\PlatformBundle\Entity\Utilisateur $recepteur
     *
     * @return Chate
     */
    public function setRecepteur(\NetUniversity\PlatformBundle\Entity\Utilisateur $recepteur)
    {
        $this->recepteur = $recepteur;

        return $this;
    }

    /**
     * Get recepteur.
     *
     * @return \NetUniversity\PlatformBundle\Entity\Utilisateur
     */
    public function getRecepteur()
    {
        return $this->recepteur;
    }
}
