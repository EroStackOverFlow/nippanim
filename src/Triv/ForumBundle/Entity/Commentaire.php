<?php
// src/Triv/ForumBundle/Entity/Commentaire.php

namespace Triv\ForumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Triv\ForumBundle\Entity\CommentaireRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Commentaire
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
   * @ORM\ManyToOne(targetEntity="Triv\ForumBundle\Entity\Forum", inversedBy="applications")
   * @ORM\JoinColumn(nullable=false)
   */
  private $advert;

  /**
   * @ORM\ManyToOne(targetEntity="Triv\UserBundle\Entity\User",inversedBy="applications")
   */
  private $user;
  
  /**
   * @ORM\Column(name="like_count", type="integer", nullable=true)
   */
  private $likecount = 0;
  
   /**
   * @ORM\Column(name="dislike_count", type="integer", nullable=true)
   */
  private $dislikecount = 0;
  
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

  public function setAdvert(Forum $advert)
  {
    $this->advert = $advert;

    return $this;
  }

  public function getAdvert()
  {
    return $this->advert;
  }

  /**
   * @ORM\PrePersist
   */
  public function increase()
  {
    $this->getAdvert()->increaseApplication();
  }

  /**
   * @ORM\PreRemove
   */
  public function decrease()
  {
    $this->getAdvert()->decreaseApplication();
  }

    /**
     * Set user
     *
     * @param \FOS\UserBundle\Model\User $user
     *
     * @return Commentaire
     */
    public function setUser(\FOS\UserBundle\Model\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \FOS\UserBundle\Model\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set like
     *
     * @param integer $like
     *
     * @return Commentaire
     */
    public function setLike($like)
    {
        $this->like = $like;

        return $this;
    }

	public function increaseLike()
    {
        $this->like++;

        return $this;
    }
	
    /**
     * Get like
     *
     * @return integer
     */
    public function getLike()
    {
        return $this->like;
    }

    /**
     * Set likeCount
     *
     * @param integer $likeCount
     *
     * @return Commentaire
     */
    public function setLikeCount($likeCount)
    {
        $this->likecount = $likeCount;

        return $this;
    }

    /**
     * Get likeCount
     *
     * @return integer
     */
    public function getLikeCount()
    {
        return $this->likecount;
    }

    /**
     * Set dislikeCount
     *
     * @param integer $dislikeCount
     *
     * @return Commentaire
     */
    public function setDislikeCount($dislikeCount)
    {
        $this->dislikecount = $dislikeCount;

        return $this;
    }

    /**
     * Get dislikeCount
     *
     * @return integer
     */
    public function getDislikeCount()
    {
        return $this->dislikecount;
    }
}
