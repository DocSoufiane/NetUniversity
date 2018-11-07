<?php

namespace NetUniversity\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\HttpFoundation\File\UploadedFile;
/**
 * Filiere
 *
 * @ORM\Table(name="filiere")
 * @ORM\Entity(repositoryClass="NetUniversity\PlatformBundle\Repository\FiliereRepository")
 */
class Filiere
{

        /**
   * @ORM\ManyToOne(targetEntity="NetUniversity\PlatformBundle\Entity\Utilisateur")
   * @ORM\JoinColumn(nullable=false)
   */
      private $Owner;

//    /**
// * @ORM\ManyToOne(targetEntity="NetUniversity\PlatformBundle\Entity\Departement")
  // * @ORM\JoinColumn(nullable=false)
   //*/
    //private $departement;


    /**
   * @ORM\ManyToOne(targetEntity="NetUniversity\PlatformBundle\Entity\Departement", inversedBy="filiere")
   * @ORM\JoinColumn(nullable=false)
   */
    private $departement;
  
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="NetUniversity\PlatformBundle\Entity\Filiere", inversedBy="sousfiliere")
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
   * @ORM\OneToMany(targetEntity="NetUniversity\PlatformBundle\Entity\Module", mappedBy="filiere")
   * @ORM\JoinColumn(nullable=false)
   */
      private $module;


    /**
   * @ORM\OneToMany(targetEntity="NetUniversity\PlatformBundle\Entity\Classe", mappedBy="filiere")
   * @ORM\JoinColumn(nullable=false)
   */
      private $classe;

 // /**
 //  * @ORM\ManyToOne(targetEntity="NetUniversity\PlatformBundle\Entity\Filiere", inversedBy="sousfiliere")
 //  * @ORM\JoinColumn(nullable=false)
 //  */
 //     private $filieremere;

    /**
   * @ORM\ManyToOne(targetEntity="NetUniversity\PlatformBundle\Entity\Filiere", inversedBy="id")
   * @ORM\JoinColumn(nullable=false)
   */
    private $sousfiliere;

    /**
    * @ORM\Column(name="urlIMAGE", type="string", length=255, nullable=true)
    */
    private $urlIMAGE;    


    /**
   * @ORM\OneToMany(targetEntity="NetUniversity\PlatformBundle\Entity\Roles", mappedBy="filiere")
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
     * @return Filiere
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
     * Set departement.
     *
     * @param \NetUniversity\PlatformBundle\Entity\Departement $departement
     *
     * @return Filiere
     */
    public function setDepartement(\NetUniversity\PlatformBundle\Entity\Departement $departement)
    {
        $this->departement = $departement;

        return $this;
    }

    /**
     * Get departement.
     *
     * @return \NetUniversity\PlatformBundle\Entity\Departement
     */
    public function getDepartement()
    {
        return $this->departement;
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
     * @return Filiere
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
     * @return Filiere
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
     * @return Filiere
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
     * Set sousfiliere.
     *
     * @param \NetUniversity\PlatformBundle\Entity\Filiere $sousfiliere
     *
     * @return Filiere
     */
    public function setSousfiliere(\NetUniversity\PlatformBundle\Entity\Filiere $sousfiliere)
    {
        $this->sousfiliere = $sousfiliere;

        return $this;
    }

    /**
     * Get sousfiliere.
     *
     * @return \NetUniversity\PlatformBundle\Entity\Filiere
     */
    public function getSousfiliere()
    {
        return $this->sousfiliere;
    } 
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->module = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add module.
     *
     * @param \NetUniversity\PlatformBundle\Entity\Module $module
     *
     * @return Filiere
     */
    public function addModule(\NetUniversity\PlatformBundle\Entity\Module $module)
    {
        $this->module[] = $module;

        return $this;
    }

    /**
     * Remove module.
     *
     * @param \NetUniversity\PlatformBundle\Entity\Module $module
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeModule(\NetUniversity\PlatformBundle\Entity\Module $module)
    {
        return $this->module->removeElement($module);
    }

    /**
     * Get module.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getModule()
    {
        return $this->module;
    }



    /**
     * Add classe.
     *
     * @param \NetUniversity\PlatformBundle\Entity\Classe $classe
     *
     * @return Filiere
     */
    public function addClasse(\NetUniversity\PlatformBundle\Entity\Classe $classe)
    {
        $this->classe[] = $classe;

        return $this;
    }

    /**
     * Remove classe.
     *
     * @param \NetUniversity\PlatformBundle\Entity\Classe $classe
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeClasse(\NetUniversity\PlatformBundle\Entity\Classe $classe)
    {
        return $this->classe->removeElement($classe);
    }

    /**
     * Get classe.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getClasse()
    {
        return $this->classe;
    }

    /**
     * Add role.
     *
     * @param \NetUniversity\PlatformBundle\Entity\Roles $role
     *
     * @return Filiere
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
     * @return Filiere
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
