<?php
// gestionController.php

namespace NetUniversity\PlatformBundle\Controller;

// N'oubliez pas ce use :
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;


use NetUniversity\PlatformBundle\Entity\Roles;
use NetUniversity\PlatformBundle\Entity\Institut;
use NetUniversity\PlatformBundle\Entity\Utilisateur;


class GestionController extends Controller
{
    public function indexAction()
    {
	    if (!$this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
	      // Sinon on déclenche une exception « Accès interdit »
	      throw new AccessDeniedException('Accès limité aux ADMINS.');
	    }

    		return $this->render('NetUniversityPlatformBundle:Gestion:index.html.twig');

	}

	public function addRoleAction(Request $request)
	{
		// On vérifie que l'utilisateur dispose bien du rôle ROLE_AUTEUR
	    if (!$this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
	      // Sinon on déclenche une exception « Accès interdit »
	      throw new AccessDeniedException('Accès limité aux ADMINS.');
	    }

		$em = $this->getDoctrine()->getManager();

		$idRole = $request->get('Role-id');
		$isChecked = $request->get('checkbox-value');
		$Categorie = $request->get('Categorie');
		$idCategorie = $request->get('idCategorie');
		
		//$Cours = $this->CoursRepository->findById($id);
	  //  $Utilisateur = $em->getRepository('NetUniversityPlatformBundle:Utilisateur')->find($id);
	    $role = $em->getRepository('NetUniversityPlatformBundle:Roles')->find($idRole);

		//$likeNEW = $Cours->getlike()+1;		
		
			//$role = new Roles();
			
			if($Categorie=="Institut"){
				$Institut = new Institut();
				$Institut = $em->getRepository('NetUniversityPlatformBundle:Institut')->find($idCategorie);

				$role->setInstitut($Institut);
				echo "Institut"; 
				if($isChecked=="Ecrire" or $isChecked=="Lire"){
					$em = $this->getDoctrine()->getManager();

					$role->setRole($isChecked);
					$em->flush();
					return new Response('Role updated successfully');
				}
			}

			if($Categorie=="Deppartement"){
				$Deppartement = $em->getRepository('NetUniversityPlatformBundle:Departement')->find($idCategorie);

				$role->setDepartement($Deppartement);
				echo "Deppartement"; 
				if($isChecked=="Ecrire" or $isChecked=="Lire"){
					$em = $this->getDoctrine()->getManager();

					$role->setRole($isChecked);
					$em->flush();
					return new Response('Role updated successfully');
				}


			}
		return new Response('error!');


	}
}

?>