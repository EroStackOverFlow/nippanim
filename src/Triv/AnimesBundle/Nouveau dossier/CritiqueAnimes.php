<?php
// src/Triv/AnimesBundle/Entity/CritiqueAnimes.php

namespace Triv\AnimesBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;



/**
 * @ORM\Entity(repositoryClass="Triv\AnimesBundle\Entity\CritiqueAnimesRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class CritiqueAnimes
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
   * @ORM\Column(name="titre", type="string", length=60, nullable = false)
   */
  private $titre;
  
  /**
   * @ORM\Column(name="genre", type="string", length=60, nullable = false)
   */
  private $genre;
  
  /**
   * @ORM\Column(name="auteur", type="string", length=60, nullable = false)
   */
  private $auteur;
  
  /**
   * @ORM\Column(name="date_sortie", type="string", length=60, nullable = false)
   */
  private $datesortie;
  
  /**
   * @ORM\Column(name="initial", type="string", length=1, nullable = false)
   */
  private $initial;

  /**
   * @ORM\Column(name="synopsi", type="text")
   */
  private $synopsi;
  
   /**
   * @ORM\Column(name="publieur", type="text")
   */
  private $publieur;



  /**
   * @ORM\OneToOne(targetEntity="Triv\AnimesBundle\Entity\CritiqueAnimesImage", cascade={"persist", "remove"})
   */
  private $image;



  /**
   * @ORM\OneToMany(targetEntity="Triv\AnimesBundle\Entity\CritiqueAnimesCommentaire", mappedBy="anime")
   */
  private $commentaires; // Notez le « s », une annonce est liée à plusieurs candidatures
  
   /**
   * @ORM\OneToMany(targetEntity="Triv\AnimesBundle\Entity\CritiqueEpisodes", mappedBy="anime")
   */
  private $episodes; // Notez le « s », une annonce est liée à plusieurs candidatures


  /**
   * @ORM\Column(name="updated_at", type="datetime", nullable=true)
   */
  private $updatedAt;

  /**
   * @ORM\Column(name="nb_commentaires", type="integer")
   */
  private $nbCommentaires = 0;

 /**
   * @ORM\Column(name="nb_episodes", type="integer")
   */
  private $nbEpisodes = 0;

  public function __construct()
  {
    $this->date         = new \Datetime();
    $this->commentaires = new ArrayCollection();
	$this->episodes = new ArrayCollection();
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
   * @return Animes
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
   * @return Animes
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
   * @param AnimesImage $image
   * @return Animes
   */
  public function setImage(CritiqueAnimesImage $image = null)
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
   * @param CritiqueAnimesCommentaire $commentaires
   * @return Animes
   */
  public function addCommentaire(CritiqueAnimesCommentaire $commentaire)
  {
    $this->commentaires[] = $commentaire;

    // On lie l'annonce à la candidature
    $commentaire->setAnime($this);

    return $this;
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

 
  
  public function increaseEpisode()
  {
    $this->nbEpisodes++;
  }

  public function decreaseEpisode()
  {
    $this->nbEpisodes--;
  }

  
   public function increaseCommentaire()
  {
    $this->nbCommentaires++;
  }

  public function decreaseCommentaire()
  {
    $this->nbCommentaires--;
  }
    /**
     * Set titre
     *
     * @param string $titre
     * @return Animes
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string 
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set synopsi
     *
     * @param string $synopsi
     * @return Animes
     */
    public function setSynopsi($synopsi)
    {
        $this->synopsi = $synopsi;

        return $this;
    }

    /**
     * Get synopsi
     *
     * @return string 
     */
    public function getSynopsi()
    {
        return $this->synopsi;
    }

  

    /**
     * Set nbCommentaires
     *
     * @param integer $nbCommentaires
     *
     * @return Animes
     */
    public function setNbCommentaires($nbCommentaires)
    {
        $this->nbCommentaires = $nbCommentaires;

        return $this;
    }

    /**
     * Get nbCommentaires
     *
     * @return integer
     */
    public function getNbCommentaires()
    {
        return $this->nbCommentaires;
    }

    /**
     * Remove commentaire
     *
     * @param \Triv\AnimesBundle\Entity\CritiqueAnimesCommentaire $commentaire
     */
    public function removeCommentaire(\Triv\AnimesBundle\Entity\CritiqueAnimesCommentaire $commentaire)
    {
        $this->commentaires->removeElement($commentaire);
    }

    /**
     * Get commentaires
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCommentaires()
    {
        return $this->commentaires;
    }

    /**
     * Set initial
     *
     * @param string $initial
     *
     * @return Animes
     */
    public function setInitial($initial)
    {
        $this->initial = $initial;

        return $this;
    }

    /**
     * Get initial
     *
     * @return string
     */
    public function getInitial()
    {
        return $this->initial;
    }

    /**
     * Set publieur
     *
     * @param string $publieur
     *
     * @return Animes
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
     * Set nbEpisodes
     *
     * @param integer $nbEpisodes
     *
     * @return Animes
     */
    public function setNbEpisodes($nbEpisodes)
    {
        $this->nbEpisodes = $nbEpisodes;

        return $this;
    }

    /**
     * Get nbEpisodes
     *
     * @return integer
     */
    public function getNbEpisodes()
    {
        return $this->nbEpisodes;
    }

    /**
     * Add episode
     *
     * @param \Triv\AnimesBundle\Entity\CritiqueEpisodes $episode
     *
     * @return Animes
     */
    public function addEpisode(\Triv\AnimesBundle\Entity\CritiqueEpisodes $episode)
    {
        $this->episodes[] = $episode;

        return $this;
    }

    /**
     * Remove episode
     *
     * @param \Triv\AnimesBundle\Entity\CritiqueEpisodes $episode
     */
    public function removeEpisode(\Triv\AnimesBundle\Entity\CritiqueEpisodes $episode)
    {
        $this->episodes->removeElement($episode);
    }

    /**
     * Get episodes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEpisodes()
    {
        return $this->episodes;
    }

    /**
     * Set genre
     *
     * @param string $genre
     *
     * @return Animes
     */
    public function setGenre($genre)
    {
        $this->genre = $genre;

        return $this;
    }

    /**
     * Get genre
     *
     * @return string
     */
    public function getGenre()
    {
        return $this->genre;
    }

    /**
     * Set auteur
     *
     * @param string $auteur
     *
     * @return Animes
     */
    public function setAuteur($auteur)
    {
        $this->auteur = $auteur;

        return $this;
    }

    /**
     * Get auteur
     *
     * @return string
     */
    public function getAuteur()
    {
        return $this->auteur;
    }

    /**
     * Set dateSortie
     *
     * @param string $dateSortie
     *
     * @return Animes
     */
    public function setDateSortie($dateSortie)
    {
        $this->datesortie = $dateSortie;

        return $this;
    }

    /**
     * Get dateSortie
     *
     * @return string
     */
    public function getDateSortie()
    {
        return $this->datesortie;
    }
}
