<?php
// src/Triv/AnimesBundle/Entity/CritiqueAnimesCommentaire.php

namespace Triv\AnimesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Triv\AnimesBundle\Entity\CritiqueAnimesCommentaireRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class CritiqueAnimesCommentaire
{
  /**
   * @ORM\Column(name="id", type="integer")
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  private $id;

  /**
   * @ORM\Column(name="author", type="string", length=255)
   */
  private $author;

  /**
   * @ORM\Column(name="content", type="text")
   */
  private $content;

  /**
   * @ORM\Column(name="date", type="datetime")
   */
  private $date;

  /**
   * @ORM\ManyToOne(targetEntity="Triv\AnimesBundle\Entity\CritiqueAnimes", inversedBy="commentaires")
   * @ORM\JoinColumn(nullable=false)
   */
  private $anime;

   /**
   * @ORM\ManyToOne(targetEntity="Triv\UserBundle\Entity\User",inversedBy="CritiqueanimeCommentaire")
   */
  private $user;
  
  public function __construct()
  {
    $this->date = new \Datetime();
  }

  public function getId()
  {
    return $this->id;
  }

  public function setAuthor($author)
  {
    $this->author = $author;

    return $this;
  }

  public function getAuthor()
  {
    return $this->author;
  }

  public function setContent($content)
  {
    $this->content = $content;

    return $this;
  }

  public function getContent()
  {
    return $this->content;
  }

  public function setDate($date)
  {
    $this->date = $date;

    return $this;
  }

  public function getDate()
  {
    return $this->date;
  }

  public function setAnime(CritiqueAnimes $anime)
  {
    $this->anime = $anime;

    return $this;
  }

  public function getAnime()
  {
    return $this->anime;
  }

  /**
   * @ORM\PrePersist
   */
  public function increase()
  {
    $this->getAnime()->increaseCommentaire();
  }

  /**
   * @ORM\PreRemove
   */
  public function decrease()
  {
    $this->getAnime()->decreaseCommentaire();
  }

    /**
     * Set user
     *
     * @param \Triv\UserBundle\Entity\User $user
     *
     * @return CritiqueAnimesCommentaire
     */
    public function setUser(\Triv\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Triv\UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}
