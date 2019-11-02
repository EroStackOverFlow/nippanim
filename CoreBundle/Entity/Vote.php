<?php

namespace Triv\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * vote
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Triv\CoreBundle\Entity\VoteRepository")
 */
class Vote
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
     * @var integer
     *
     * @ORM\Column(name="ref_id", type="integer")
     */
    private $refId;

    /**
     * @var string
     *
     * @ORM\Column(name="ref", type="string", length=100)
     */
    private $ref;

    /**
     * @var integer
     *
     * @ORM\Column(name="user_id", type="integer")
     */
    private $userId;

    /**
     * @var integer
     *
     * @ORM\Column(name="vote", type="integer")
     */
    private $vote;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

 public function __construct()
  {
    $this->createdAt = new \Datetime();
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
     * Set refId
     *
     * @param integer $refId
     *
     * @return vote
     */
    public function setRefId($refId)
    {
        $this->refId = $refId;

        return $this;
    }

    /**
     * Get refId
     *
     * @return integer
     */
    public function getRefId()
    {
        return $this->refId;
    }

    /**
     * Set ref
     *
     * @param string $ref
     *
     * @return vote
     */
    public function setRef($ref)
    {
        $this->ref = $ref;

        return $this;
    }

    /**
     * Get ref
     *
     * @return string
     */
    public function getRef()
    {
        return $this->ref;
    }

    /**
     * Set userId
     *
     * @param integer $userId
     *
     * @return vote
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return integer
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set vote
     *
     * @param integer $vote
     *
     * @return vote
     */
    public function setVote($vote)
    {
        $this->vote = $vote;

        return $this;
    }

    /**
     * Get vote
     *
     * @return integer
     */
    public function getVote()
    {
        return $this->vote;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return vote
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
}

