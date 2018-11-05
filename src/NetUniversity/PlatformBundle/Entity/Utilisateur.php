<?php

namespace NetUniversity\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Security\Core\User\UserInterface;
use NetUniversity\PlatformBundle\Repository\ContactsRepository;
use Doctrine\ORM\EntityRepository;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;

use FOS\UserBundle\Model\User as BaseUser;
use NetUniversity\UserBundle;

/**
 * User
 *
 * @ORM\Table(name="utilisateur")
 * @ORM\Entity(repositoryClass="NetUniversity\PlatformBundle\Repository\UtilisateurRepository")
 */


class Utilisateur extends BaseUser
{
    /**
   * @ORM\ManyToOne(targetEntity="NetUniversity\PlatformBundle\Entity\Localisation")
   * @ORM\JoinColumn(nullable=true)
   */
    private $localisation;
        
    /**
   * @ORM\ManyToOne(targetEntity="NetUniversity\PlatformBundle\Entity\University", inversedBy="utilisateur")
   * @ORM\JoinColumn(nullable=true)
   */
    private $University;

    /**
   * @ORM\ManyToOne(targetEntity="NetUniversity\PlatformBundle\Entity\University", inversedBy="owner")
   * @ORM\JoinColumn(nullable=true)
   */
    private $MyUniversity;


    /**
   * @ORM\ManyToOne(targetEntity="NetUniversity\PlatformBundle\Entity\Institut", inversedBy="utilisateur")
   * @ORM\JoinColumn(nullable=true)
   */
    private $Institut;

    /**
   * @ORM\ManyToOne(targetEntity="NetUniversity\PlatformBundle\Entity\Departement", inversedBy="utilisateur")
   * @ORM\JoinColumn(nullable=true)
   */
    private $Deppartement;

    /**
   * @ORM\ManyToOne(targetEntity="NetUniversity\PlatformBundle\Entity\Filiere", inversedBy="utilisateur")
   * @ORM\JoinColumn(nullable=true)
   */
    private $Filiere;
  
    /**
   * @ORM\ManyToOne(targetEntity="NetUniversity\PlatformBundle\Entity\Classe", inversedBy="Etudiant")
   * @ORM\JoinColumn(nullable=true)
   */
    private $classe;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="Nom", type="string", length=255, nullable=true)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="Prenom", type="string", length=255, nullable=true)
     */
    private $prenom;
    
      /**
       * @ORM\Column(name="urlIMAGE", type="string", length=255, nullable=true)
       */
      private $urlIMAGE;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateDinscription", type="datetime", nullable=true)
     */
    private $dateDinscription;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255, nullable=true)
     */
    private $type;

    /**
     * @var int
     *
     * @ORM\Column(name="age", type="integer", nullable=true)
     */
    private $age;


    /**
    * @ORM\Column(name="dernierevisite", type="datetime", nullable=true)
    */
    private $dernierevisite;

    /**
   * @ORM\OneToMany(targetEntity="NetUniversity\PlatformBundle\Entity\Roles", mappedBy="user")
   * @ORM\JoinColumn(nullable=true)
   */
    private $role;


    /**
     * Get id.
     *
     * @return int
     */

    public function __construct()
    {

        parent::__construct();
        
        // your own logic

    }

    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nom.
     *
     * @param string $nom
     *
     * @return User
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
     * Set prenom.
     *
     * @param string $prenom
     *
     * @return User
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom.
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set dateDinscription.
     *
     * @param \DateTime $dateDinscription
     *
     * @return User
     */
    public function setDateDinscription($dateDinscription)
    {
        $this->dateDinscription = $dateDinscription;

        return $this;
    }

    /**
     * Get dateDinscription.
     *
     * @return \DateTime
     */
    public function getDateDinscription()
    {
        return $this->dateDinscription;
    }

    /**
     * Set type.
     *
     * @param string $type
     *
     * @return User
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type.
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set age.
     *
     * @param int $age
     *
     * @return User
     */
    public function setAge($age)
    {
        $this->age = $age;

        return $this;
    }

    /**
     * Get age.
     *
     * @return int
     */
    public function getAge()
    {
        return $this->age;
    }



    /**
     * Set dernierevisite.
     *
     * @param \DateTime $dernierevisite
     *
     * @return User
     */
    public function setDernierevisite($dernierevisite)
    {
        $this->dernierevisite = $dernierevisite;

        return $this;
    }

    /**
     * Get dernierevisite.
     *
     * @return \DateTime
     */
    public function getDernierevisite()
    {
        return $this->dernierevisite;
    }


    /**
     * Get Contacts.
     *
     * @return \NetUniversity\PlatformBundle\Entity\Utilisateur
     */
    public function getContacts()
    {
       
 /*       $Contacts = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('NetUniversityPlatformBundle:Contacts')
            ->findByUser($this)
          ;
        return $Contacts; */
    }


  // Notez le singulier, on ajoute une seule catégorie à la fois

 

    /**
     * Set localisation.
     *
     * @param \NetUniversity\PlatformBundle\Entity\Localisation $localisation
     *
     * @return Utilisateur
     */
    public function setLocalisation(\NetUniversity\PlatformBundle\Entity\Localisation $localisation)
    {
        $this->localisation = $localisation;
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
     * @param \NetUniversity\PlatformBundle\Entity\University|null $university
     *
     * @return Utilisateur
     */
    public function setUniversity(\NetUniversity\PlatformBundle\Entity\University $university = null)
    {
        $this->University = $university;

        return $this;
    }

    /**
     * Get university.
     *
     * @return \NetUniversity\PlatformBundle\Entity\University|null
     */
    public function getUniversity()
    {
        return $this->University;
    }

    /**
     * @Assert\File(
     *     maxSize = "15024k",
     *     mimeTypes = {"image/png", "image/vnd.sealedmedia.softseal.jpg", "video/JPEG"},
     *     mimeTypesMessage = "Tail maximal 15 Mo | type de fichier acceptés (jpg, png, jpeg)"
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
     * Set urlIMAGE.
     *
     * @param string $urlIMAGE
     *
     * @return Utilisateur
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

    public function upload()
  {
    // Si jamais il n'y a pas de fichier (champ facultatif), on ne fait rien
    if (null === $this->file) {
         $this->urlIMAGE = '../uploads/img/avatar.jpg';
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
     * Add university.
     *
     * @param \NetUniversity\PlatformBundle\Entity\University $university
     *
     * @return Utilisateur
     */
    public function addUniversity(\NetUniversity\PlatformBundle\Entity\University $university)
    {
        $this->University[] = $university;

        return $this;
    }

    /**
     * Remove university.
     *
     * @param \NetUniversity\PlatformBundle\Entity\University $university
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeUniversity(\NetUniversity\PlatformBundle\Entity\University $university)
    {
        return $this->University->removeElement($university);
    }

    /**
     * Set institut.
     *
     * @param \NetUniversity\PlatformBundle\Entity\Institut|null $institut
     *
     * @return Utilisateur
     */
    public function setInstitut(\NetUniversity\PlatformBundle\Entity\Institut $institut = null)
    {
        $this->Institut = $institut;

        return $this;
    }

    /**
     * Get institut.
     *
     * @return \NetUniversity\PlatformBundle\Entity\Institut|null
     */
    public function getInstitut()
    {
        return $this->Institut;
    }

    /**
     * Set deppartement.
     *
     * @param \NetUniversity\PlatformBundle\Entity\Departement|null $deppartement
     *
     * @return Utilisateur
     */
    public function setDeppartement(\NetUniversity\PlatformBundle\Entity\Departement $deppartement = null)
    {
        $this->Deppartement = $deppartement;

        return $this;
    }

    /**
     * Get deppartement.
     *
     * @return \NetUniversity\PlatformBundle\Entity\Departement|null
     */
    public function getDeppartement()
    {
        return $this->Deppartement;
    }

    /**
     * Set filiere.
     *
     * @param \NetUniversity\PlatformBundle\Entity\Filiere|null $filiere
     *
     * @return Utilisateur
     */
    public function setFiliere(\NetUniversity\PlatformBundle\Entity\Filiere $filiere = null)
    {
        $this->Filiere = $filiere;

        return $this;
    }

    /**
     * Get filiere.
     *
     * @return \NetUniversity\PlatformBundle\Entity\Filiere|null
     */
    public function getFiliere()
    {
        return $this->Filiere;
    }

    /**
     * Set classe.
     *
     * @param \NetUniversity\PlatformBundle\Entity\Classe|null $classe
     *
     * @return Utilisateur
     */
    public function setClasse(\NetUniversity\PlatformBundle\Entity\Classe $classe = null)
    {
        $this->classe = $classe;

        return $this;
    }

    /**
     * Get classe.
     *
     * @return \NetUniversity\PlatformBundle\Entity\Classe|null
     */
    public function getClasse()
    {
        return $this->classe;
    }

    /**
     * Set myUniversity.
     *
     * @param \NetUniversity\PlatformBundle\Entity\University|null $myUniversity
     *
     * @return Utilisateur
     */
    public function setMyUniversity(\NetUniversity\PlatformBundle\Entity\University $myUniversity = null)
    {
        $this->MyUniversity = $myUniversity;

        return $this;
    }

    /**
     * Get myUniversity.
     *
     * @return \NetUniversity\PlatformBundle\Entity\University|null
     */
    public function getMyUniversity()
    {
        return $this->MyUniversity;
    }

    /**
     * Get role.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRole()
    {
        return $this->role;
    }
}
