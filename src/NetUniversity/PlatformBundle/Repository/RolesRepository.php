<?php

namespace NetUniversity\PlatformBundle\Repository;

use NetUniversity\PlatformBundle\Entity\Institut;
use NetUniversity\PlatformBundle\Entity\Departement;
use NetUniversity\PlatformBundle\Entity\Utilisateur;
/**
 * RolesRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class RolesRepository extends \Doctrine\ORM\EntityRepository
{
		public function Check(Institut $i, Utilisateur $u)
	{
	  $qb = $this->createQueryBuilder('a');

	  $qb->where('a.institut = :Institut AND a.User= :User')
	       ->setParameter('Institut', $i)
	       ->setParameter('User', $u)
	  ;

	  return $qb
	    ->getQuery()
	    ->getResult()
	  ;
	}
	
	
	public function CheckDeppartement(Departement $d, Utilisateur $u)
	{
	  $qb = $this->createQueryBuilder('a');

	  $qb->where('a.departement = :Departement AND a.User= :User')
	       ->setParameter('Departement', $d)
	       ->setParameter('User', $u)
	  ;

	  return $qb
	    ->getQuery()
	    ->getResult()
	  ;
	}

	public function CheckFiliere(Filiere $f, Utilisateur $u)
	{
	  $qb = $this->createQueryBuilder('a');

	  $qb->where('a.filiere = :Filiere AND a.User= :User')
	       ->setParameter('Filiere', $f)
	       ->setParameter('User', $u)
	  ;

	  return $qb
	    ->getQuery()
	    ->getResult()
	  ;
	}

}
