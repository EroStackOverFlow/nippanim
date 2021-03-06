<?php
// src/Triv/ForumBundle/Entity/Forum.php

namespace Triv\ForumBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;



/**
 * @ORM\Entity(repositoryClass="Triv\ForumBundle\Entity\ForumRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Forum
{
  /**
   * @ORM\Column(name="id", type="integer")
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  private $id;

  /**
   * @ORM\Column(name="date", type="datetime")
   */
  private $date;

  /**
   * @ORM\Column(name="author", type="string", length=255)
   */
  private $author;

  /**
   * @ORM\Column(name="content", type="text")
   * @Assert\NotBlank()
   * @Assert\Length(max=255)
   */
  private $content;



  /**
   * @ORM\OneToOne(targetEntity="Triv\ForumBundle\Entity\ForumImage", cascade={"persist", "remove"})
   * @Assert\Valid()
   */
  private $image;



  /**
   * @ORM\OneToMany(targetEntity="Triv\ForumBundle\Entity\Commentaire", mappedBy="advert")
   */
  private $applications; // Notez le « s », une annonce est liée à plusieurs candidatures

  /**
   * @ORM\Column(name="updated_at", type="datetime", nullable=true)
   */
  private $updatedAt;

  /**
   * @ORM\Column(name="nb_applications", type="integer")
   */
  private $nbApplications = 0;
  
  

  /**
   * @ORM\ManyToOne(targetEntity="Triv\UserBundle\Entity\User",inversedBy="forum")
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
    $this->date         = new \Datetime();
    $this->applications = new ArrayCollection();
  }

  /**
   * @return integer
   */
  public function getId()
  {
    return $this->id;
  }

  /**
   * @param \DateTime $date
   * @return Forum
   */
  public function setDate($date)
  {
    $this->date = $date;
    return $this;
  }

  /**
   * @return \DateTime
   */
  public function getDate()
  {
    return $this->date;
  }


  /**
   * @param string $author
   * @return Forum
   */
  public function setAuthor($author)
  {
    $this->author = $author;
    return $this;
  }

  /**
   * @return string
   */
  public function getAuthor()
  {
    return $this->author;
  }

  /**
   * @param string $content
   * @return Forum
   */
  public function setContent($content)
  {
    $this->content = $content;
    return $this;
  }

  /**
   * @return string
   */
  public function getContent()
  {
    return $this->content;
  }


  /**
   * @param ForumImage $image
   * @return Forum
   */
  public function setImage(ForumImage $image = null)
  {
    $this->image = $image;
    return $this;
  }

  /**
   * @return Image
   */
  public function getImage()
  {
    return $this->image;
  }

  

  /**
   * @param Commentaire $application
   * @return Forum
   */
  public function addApplication(Commentaire $application)
  {
    $this->applications[] = $application;

    // On lie l'annonce à la candidature
    $application->setAdvert($this);

    return $this;
  }

  /**
   * @param Commentaire $application
   */
  public function removeApplication(Commentaire $application)
  {
    $this->applications->removeElement($application);

    // Et si notre relation était facultative (nullable=true, ce qui n'est pas notre cas ici attention) :
    // $application->setAdvert(null);
  }

  /**
   * @return ArrayCollection
   */
  public function getApplications()
  {
    return $this->applications;
  }

  /**
   * @ORM\PreUpdate
   */
  public function updateDate()
  {
    $this->setUpdatedAt(new \Datetime());
  }

  public function setUpdatedAt(\Datetime $updatedAt)
  {
    $this->updatedAt = $updatedAt;
    return $this;
  }

  public function getUpdatedAt()
  {
    return $this->updatedAt;
  }

  public function increaseApplication()
  {
    $this->nbApplications++;
  }

  public function decreaseApplication()
  {
    $this->nbApplications--;
  }

    /**
     * Set nbApplications
     *
     * @param integer $nbApplications
     *
     * @return Forum
     */
    public function setNbApplications($nbApplications)
    {
        $this->nbApplications = $nbApplications;

        return $this;
    }

    /**
     * Get nbApplications
     *
     * @return integer
     */
    public function getNbApplications()
    {
        return $this->nbApplications;
    }

    /**
     * Set user
     *
     * @param \Triv\UserBundle\Entity\User $user
     *
     * @return Forum
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

    /**
     * Set like
     *
     * @param integer $like
     *
     * @return Forum
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
     * @return Forum
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
     * @return Forum
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
