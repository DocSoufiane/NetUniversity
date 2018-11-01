<?php

namespace NetUniversity\PlatformBundle\Repository;

/**
 * UtilisateurRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class UtilisateurRepository extends \Doctrine\ORM\EntityRepository
{
	public function getUniversityByUser($pattern){
		
		 return $this
      ->createQueryBuilder('c')
      ->where('c.id = :pattern')
      ->setParameter('pattern', $pattern)
    ;

	}
}