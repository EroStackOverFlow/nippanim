<?php
// src/Triv/AnimesBundle/Entity/CritiqueAnimesCommentaireRepository.php

namespace Triv\AnimesBundle\Entity;

use Doctrine\ORM\EntityRepository;

class CritiqueAnimesCommentaireRepository extends EntityRepository
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
}
