<?php

namespace NetUniversity\PlatformBundle\Repository;

/**
 * InstitutRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class InstitutRepository extends \Doctrine\ORM\EntityRepository
{
	public function getInstitutByUniversity($UniversityID)
	  {
	    return $this
      ->createQueryBuilder('c')
      ->where('c.university_id = :UniversityID')
      ->setParameter('UniversityID', $UniversityID)
    	;
	  }

}
