<?php

namespace Triv\QuizzBundle\Entity;

/**
 * QuizzRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class QuizzRepository extends \Doctrine\ORM\EntityRepository
{
	 public function getNb() {
 
        return $this->createQueryBuilder('a')
 
                        ->select('COUNT(a)')
 
                        ->getQuery()
 
                        ->getSingleScalarResult();
 
    }
	
}