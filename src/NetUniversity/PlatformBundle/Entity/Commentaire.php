<?php

namespace NetUniversity\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Commentaire
 *
 * @ORM\Table(name="commentaire")
 * @ORM\Entity(repositoryClass="NetUniversity\PlatformBundle\Repository\CommentaireRepository")
 */
class Commentaire
{

    /**
   * @ORM\ManyToOne(targetEntity="NetUniversity\PlatformBundle\Entity\Sujet", inversedBy="commentaire")
   * @ORM\JoinColumn(nullable=true)
   */
    private $sujet;

    /**
   * @ORM\ManyToOne(targetEntity="NetUniversity\PlatformBundle\Entity\Cours", cascade={"remove"}, inversedBy="commentaire")
   * @ORM\JoinColumn(nullable=true)
   */
    private $cours;

    /**
   * @ORM\ManyToOne(targetEntity="NetUniversity\PlatformBundle\Entity\Utilisateur")
   * @ORM\JoinColumn(nullable=true)
   */
    private $utilisateur;

    /**
   * @ORM\ManyToOne(targetEntity="NetUniversity\PlatformBundle\Entity\Commentaire", cascade={"remove"}, inversedBy="CommentaireFils")
   * @ORM\JoinColumn(nullable=true)
   */
    private $CommentaireMere;

        /**
   * @ORM\OneToMany(targetEntity="NetUniversity\PlatformBundle\Entity\Commentaire", mappedBy="CommentaireMere")
   * @ORM\JoinColumn(nullable=true)
   */
    private $CommentaireFils;

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
     * @ORM\Column(name="Comment", type="text")
     */
    private $comment;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DateDuComment", type="datetime")
     */
    private $dateDuComment;


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
     * Set comment.
     *
     * @param string $comment
     *
     * @return Commentaire
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment.
     *
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set dateDuComment.
     *
     * @param \DateTime $dateDuComment
     *
     * @return Commentaire
     */
    public function setDateDuComment($dateDuComment)
    {
        $this->dateDuComment = $dateDuComment;

        return $this;
    }

    /**
     * Get dateDuComment.
     *
     * @return \DateTime
     */
    public function getDateDuComment()
    {
        return $this->dateDuComment;
    }

    /**
     * Set sujet.
     *
     * @param \NetUniversity\PlatformBundle\Entity\Sujet $sujet
     *
     * @return Commentaire
     */
    public function setSujet(\NetUniversity\PlatformBundle\Entity\Sujet $sujet)
    {
        $this->sujet = $sujet;

        return $this;
    }

    /**
     * Get sujet.
     *
     * @return \NetUniversity\PlatformBundle\Entity\Sujet
     */
    public function getSujet()
    {
        return $this->sujet;
    }

    /**
     * Set cours.
     *
     * @param \NetUniversity\PlatformBundle\Entity\Cours $cours
     *
     * @return Commentaire
     */
    public function setCours(\NetUniversity\PlatformBundle\Entity\Cours $cours)
    {
        $this->cours = $cours;

        return $this;
    }

    /**
     * Get cours.
     *
     * @return \NetUniversity\PlatformBundle\Entity\Cours
     */
    public function getCours()
    {
        return $this->cours;
    }

    /**
     * Set utilisateur.
     *
     * @param \NetUniversity\PlatformBundle\Entity\Utilisateur $utilisateur
     *
     * @return Commentaire
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
     * Set commentaireMere.
     *
     * @param \NetUniversity\PlatformBundle\Entity\Commentaire|null $commentaireMere
     *
     * @return Commentaire
     */
    public function setCommentaireMere(\NetUniversity\PlatformBundle\Entity\Commentaire $commentaireMere = null)
    {
        $this->CommentaireMere = $commentaireMere;

        return $this;
    }

    /**
     * Get commentaireMere.
     *
     * @return \NetUniversity\PlatformBundle\Entity\Commentaire|null
     */
    public function getCommentaireMere()
    {
        return $this->CommentaireMere;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->CommentaireFils = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add commentaireFil.
     *
     * @param \NetUniversity\PlatformBundle\Entity\Commentaire $commentaireFil
     *
     * @return Commentaire
     */
    public function addCommentaireFil(\NetUniversity\PlatformBundle\Entity\Commentaire $commentaireFil)
    {
        $this->CommentaireFils[] = $commentaireFil;

        return $this;
    }

    /**
     * Remove commentaireFil.
     *
     * @param \NetUniversity\PlatformBundle\Entity\Commentaire $commentaireFil
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeCommentaireFil(\NetUniversity\PlatformBundle\Entity\Commentaire $commentaireFil)
    {
        return $this->CommentaireFils->removeElement($commentaireFil);
    }

    /**
     * Get commentaireFils.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCommentaireFils()
    {
        return $this->CommentaireFils;
    }
}
