<?php

namespace NetUniversity\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Publication
 *
 * @ORM\Table(name="publication")
 * @ORM\Entity(repositoryClass="NetUniversity\PlatformBundle\Repository\PublicationRepository")
 */
class Publication
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
    * @ORM\ManyToMany(targetEntity="NetUniversity\PlatformBundle\Entity\Category", cascade={"persist"})
    * @ORM\JoinTable(name="netuniversity_publication_category")
    */
    private $categories;


    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="lien", type="string", length=255)
     */
    private $lien;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datededepos", type="datetime")
     */
    private $datededepos;


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
     * @return Publication
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
     * Set lien.
     *
     * @param string $lien
     *
     * @return Publication
     */
    public function setLien($lien)
    {
        $this->lien = $lien;

        return $this;
    }

    /**
     * Get lien.
     *
     * @return string
     */
    public function getLien()
    {
        return $this->lien;
    }

    /**
     * Set datededepos.
     *
     * @param \DateTime $datededepos
     *
     * @return Publication
     */
    public function setDatededepos($datededepos)
    {
        $this->datededepos = $datededepos;

        return $this;
    }

    /**
     * Get datededepos.
     *
     * @return \DateTime
     */
    public function getDatededepos()
    {
        return $this->datededepos;
    }
  public function __construct()
  {
    $this->datededepos = new \Datetime();
  }
    

    /**
     * Add category.
     *
     * @param \NetUniversity\PlatformBundle\Entity\Category $category
     *
     * @return Publication
     */
    public function addCategory(\NetUniversity\PlatformBundle\Entity\Category $category)
    {
        $this->categories[] = $category;

        return $this;
    }

    /**
     * Remove category.
     *
     * @param \NetUniversity\PlatformBundle\Entity\Category $category
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeCategory(\NetUniversity\PlatformBundle\Entity\Category $category)
    {
        return $this->categories->removeElement($category);
    }

    /**
     * Get categories.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * Set utilisateur.
     *
     * @param \NetUniversity\PlatformBundle\Entity\Utilisateur $utilisateur
     *
     * @return Publication
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
