<?php
// src/Triv/ForumBundle/Entity/CommentaireRepository.php

namespace Triv\ForumBundle\Entity;

use Doctrine\ORM\EntityRepository;

class CommentaireRepository extends EntityRepository
{
  public function analyzeIP($ipAddress)
  {
    return $this->createQueryBuilder('a')
      ->join('a.logIP', 'l')
      ->where('l.IPAddress = :ip')
      ->setParameter('ip', $ipAddress)
      ->orderBy('l.date', 'desc')
      ->getQuery()
      ->getResult()
    ;
  }

  public function getApplicationsWithAdvert($limit)
  {
    $qb = $this->createQueryBuilder('a');

    // On fait une jointure avec l'entité Advert avec pour alias « adv »
    $qb
      ->join('a.advert', 'adv')
      ->addSelect('adv')
    ;

    // Puis on ne retourne que $limit résultats
    $qb->setMaxResults($limit);

    // Enfin, on retourne le résultat
    return $qb
      ->getQuery()
      ->getResult()
      ;
  }
  
  
  	public function getNb() {
 
        return $this->createQueryBuilder('c')
 
                        ->select('COUNT(c)')
 
                        ->getQuery()
 
                        ->getSingleScalarResult();
 
    }
	
	public function getNbPerUser($id) {
 
        return $this->createQueryBuilder('c')
 
                        ->select('COUNT(c)')
						->where('c.user = :u')
	                    ->setParameter('u', $id  )
 
                        ->getQuery()
 
                        ->getSingleScalarResult();
 
    }
}
