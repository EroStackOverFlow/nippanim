<?php

namespace Triv\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="Triv\UserBundle\Entity\UserRepository")
 */
class User extends BaseUser
{
  /**
   * @ORM\Column(name="id", type="integer")
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  protected $id;
  

  
  /**
   * @ORM\OneToOne(targetEntity="Triv\UserBundle\Entity\UserImage", cascade={"persist", "remove"})
   * @Assert\Valid()
   */
  private $image;
  
   /**
   * @ORM\OneToMany(targetEntity="Triv\ForumBundle\Entity\Commentaire", mappedBy="user")
   */
  private $applications; // Notez le « s », une annonce est liée à plusieurs candidatures
  
   /**
   * @ORM\OneToMany(targetEntity="Triv\AnimesBundle\Entity\AnimesCommentaire", mappedBy="user")
   */
  private $animeCommentaire; // Notez le « s », une annonce est liée à plusieurs candidatures
  
  
    /**
   * @ORM\OneToMany(targetEntity="Triv\ForumBundle\Entity\Commentaire", mappedBy="user")
   */
  private $forum; // Notez le « s », une annonce est liée à plusieurs candidatures
  
 /**
   * @ORM\Column(name="dateIns", type="datetime" ,nullable=true)
   */
  protected $dateIns;
  
  
   /**
   * @param UserImage $image
   * @return User
   */
  public function setImage(UserImage $image = null)
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
  
  
  public function getId()
  {
    return $this->id;
  }

    /**
     * Add application
     *
     * @param \Triv\ForumBundle\Entity\Commentaire $application
     *
     * @return User
     */
    public function addApplication(\Triv\ForumBundle\Entity\Commentaire $application)
    {
        $this->applications[] = $application;
        $application->setUser($this);

        return $this;
    }

    /**
     * Remove application
     *
     * @param \Triv\ForumBundle\Entity\Commentaire $application
     */
    public function removeApplication(\Triv\ForumBundle\Entity\Commentaire $application)
    {
        $this->applications->removeElement($application);
    }

    /**
     * Get applications
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getApplications()
    {
        return $this->applications;
    }

    /**
     * Add forum
     *
     * @param \Triv\ForumBundle\Entity\Commentaire $forum
     *
     * @return User
     */
    public function addForum(\Triv\ForumBundle\Entity\Commentaire $forum)
    {
        $this->forum[] = $forum;
        $forum->setUser($this);

        return $this;
    }

    /**
     * Remove forum
     *
     * @param \Triv\ForumBundle\Entity\Commentaire $forum
     */
    public function removeForum(\Triv\ForumBundle\Entity\Commentaire $forum)
    {
        $this->forum->removeElement($forum);
    }

    /**
     * Get forum
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getForum()
    {
        return $this->forum;
    }

    /**
     * Add animeCommentaire
     *
     * @param \Triv\AnimesBundle\Entity\AnimesCommentaire $animeCommentaire
     *
     * @return User
     */
    public function addAnimeCommentaire(\Triv\AnimesBundle\Entity\AnimesCommentaire $animeCommentaire)
    {
        $this->animeCommentaire[] = $animeCommentaire;

        return $this;
    }

    /**
     * Remove animeCommentaire
     *
     * @param \Triv\AnimesBundle\Entity\AnimesCommentaire $animeCommentaire
     */
    public function removeAnimeCommentaire(\Triv\AnimesBundle\Entity\AnimesCommentaire $animeCommentaire)
    {
        $this->animeCommentaire->removeElement($animeCommentaire);
    }

    /**
     * Get animeCommentaire
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAnimeCommentaire()
    {
        return $this->animeCommentaire;
    }


    /**
     * Set nblike
     *
     * @param integer $nblike
     *
     * @return User
     */
    public function setNblike($nblike)
    {
        $this->nblike = $nblike;

        return $this;
    }
	
	 public function increaseLike()
    {
        $this->nblike++;

        return $this;
    }

    /**
     * Get nblike
     *
     * @return integer
     */
    public function getNblike()
    {
        return $this->nblike;
    }
	
 

    /**
     * Set dateIns
     *
     * @param \DateTime $dateIns
     *
     * @return User
     */
    public function setDateIns($dateIns)
    {
        $this->dateIns = $dateIns;

        return $this;
    }

    /**
     * Get dateIns
     *
     * @return \DateTime
     */
    public function getDateIns()
    {
        return $this->dateIns;
    }
}
