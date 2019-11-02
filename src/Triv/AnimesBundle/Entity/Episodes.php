<?php

namespace Triv\AnimesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Episodes
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class Episodes
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

	/**
     * @ORM\ManyToOne(targetEntity="Triv\AnimesBundle\Entity\Animes", inversedBy="episodes")
     * @ORM\JoinColumn(nullable=false)
     */
private $anime;
	
	  /**
   * @ORM\Column(name="date", type="datetime")
   */
  private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=25)
	 * @Assert\Length(max=15)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="src", type="string")
     */
    private $src;
   /**
     * @var string
     *
     * @ORM\Column(name="publieur", type="string")
     */
    private $publieur;
	
	
	/**
     * @var string
     *
     * @ORM\Column(name="ep_version", type="string", length=25, nullable = true)
	 * @Assert\Length(max=15)
     */
    private $epversion;

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
  }
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

 
    /**
     * Set title
     *
     * @param string $title
     * @return Episodes
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set src
     *
     * @param string $src
     * @return Episodes
     */
    public function setSrc($src)
    {
        $this->src = $src;

        return $this;
    }

    /**
     * Get src
     *
     * @return string 
     */
    public function getSrc()
    {
        return $this->src;
    }
   


    
    /**
     * Set Animes
     *
     * @param \Triv\AnimesBundle\Entity\Animes $animes
     * @return Episodes
     */
    public function setAnimes(\Triv\AnimesBundle\Entity\Animes $animes)
    {
        $this->$animes = $animes;

        return $this;
    }

    /**
     * Get Animes
     *
     * @return \Triv\AnimesBundle\Entity\Animes 
     */
    public function getAnimes()
    {
        return $this->Animes;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Episodes
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set anime
     *
     * @param \Triv\AnimesBundle\Entity\Animes $anime
     *
     * @return Episodes
     */
    public function setAnime(\Triv\AnimesBundle\Entity\Animes $anime)
    {
        $this->anime = $anime;

        return $this;
    }

    /**
     * Get anime
     *
     * @return \Triv\AnimesBundle\Entity\Animes
     */
    public function getAnime()
    {
        return $this->anime;
    }
	
	/**
   * @ORM\PrePersist
   */
  public function increase()
  {
    $this->getAnime()->increaseEpisode();
  }

  /**
   * @ORM\PreRemove
   */
  public function decrease()
  {
    $this->getAnime()->decreaseEpisode();
  }

    /**
     * Set ep
     *
     * @param integer $ep
     *
     * @return Episodes
     */
    public function setEp($ep)
    {
        $this->ep = $ep;

        return $this;
    }

    /**
     * Get ep
     *
     * @return integer
     */
    public function getEp()
    {
        return $this->ep;
    }

    /**
     * Set publieur
     *
     * @param string $publieur
     *
     * @return Episodes
     */
    public function setPublieur($publieur)
    {
        $this->publieur = $publieur;

        return $this;
    }

    /**
     * Get publieur
     *
     * @return string
     */
    public function getPublieur()
    {
        return $this->publieur;
    }

    /**
     * Set epVersion
     *
     * @param string $epVersion
     *
     * @return Episodes
     */
    public function setEpVersion($epVersion)
    {
        $this->epversion = $epVersion;

        return $this;
    }

    /**
     * Get epVersion
     *
     * @return string
     */
    public function getEpVersion()
    {
        return $this->epversion;
    }
	
	  /**
     * Set likeCount
     *
     * @param integer $likeCount
     *
     * @return AnimesCommentaire
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
     * @return AnimesCommentaire
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
