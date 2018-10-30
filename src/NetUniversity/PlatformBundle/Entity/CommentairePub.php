<?php

namespace NetUniversity\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CommentairePub
 *
 * @ORM\Table(name="commentaire_pub")
 * @ORM\Entity(repositoryClass="NetUniversity\PlatformBundle\Repository\CommentairePubRepository")
 */
class CommentairePub
{
    /**
   * @ORM\ManyToOne(targetEntity="NetUniversity\PlatformBundle\Entity\CommentairePub")
   * @ORM\JoinColumn(nullable=false)
   */
    private $commentairePere;

    /**
   * @ORM\ManyToOne(targetEntity="NetUniversity\PlatformBundle\Entity\Publication")
   * @ORM\JoinColumn(nullable=false)
   */
    private $publication;

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
     * @return CommentairePub
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
     * @return CommentairePub
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
     * Set commentairePere.
     *
     * @param \NetUniversity\PlatformBundle\Entity\CommentairePub $commentairePere
     *
     * @return CommentairePub
     */
    public function setCommentairePere(\NetUniversity\PlatformBundle\Entity\CommentairePub $commentairePere)
    {
        $this->commentairePere = $commentairePere;

        return $this;
    }

    /**
     * Get commentairePere.
     *
     * @return \NetUniversity\PlatformBundle\Entity\CommentairePub
     */
    public function getCommentairePere()
    {
        return $this->commentairePere;
    }

    /**
     * Set publication.
     *
     * @param \NetUniversity\PlatformBundle\Entity\Publication $publication
     *
     * @return CommentairePub
     */
    public function setPublication(\NetUniversity\PlatformBundle\Entity\Publication $publication)
    {
        $this->publication = $publication;

        return $this;
    }

    /**
     * Get publication.
     *
     * @return \NetUniversity\PlatformBundle\Entity\Publication
     */
    public function getPublication()
    {
        return $this->publication;
    }

    /**
     * Set utilisateur.
     *
     * @param \NetUniversity\PlatformBundle\Entity\Utilisateur $utilisateur
     *
     * @return CommentairePub
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
