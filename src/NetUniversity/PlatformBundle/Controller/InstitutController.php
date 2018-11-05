<?php
// inscriptionController.php
namespace NetUniversity\PlatformBundle\Controller;

use NetUniversity\PlatformBundle\Entity\Institut;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use NetUniversity\PlatformBundle\Form\InstitutType;

//use NetUniversity\PlatformBundle\Form\LocalisationType;
use Symfony\Component\Serializer\SerializerInterface;

use Symfony\Component\HttpFoundation\JsonResponse;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
//use Symfony\Component\Validator\Constraints\DateTime;
//use JMS\Serializer\SerializerBuilder;



class InstitutController extends Controller
{

	public function GestionIndexAction(Request $request, $InstitutId){
		if (!$this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
	      // Sinon on déclenche une exception « Accès interdit »
	      throw new AccessDeniedException('Accès limité aux ADMINS.');
	    }

    		return $this->render('NetUniversityPlatformBundle:Institut:Gestionindex.html.twig', array('InstitutId'=> $InstitutId));
	}

	public function GestionRoleAction(Request $request, $InstitutId){
		$em = $this->getDoctrine()->getManager();
							    // On vérifie que l'utilisateur dispose bien du rôle ROLE_AUTEUR
			    if (!$this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
			      // Sinon on déclenche une exception « Accès interdit »
			      throw new AccessDeniedException('Accès limité aux ADMINS.');
			    }

		// La méthode findAll retourne toutes les catégories de la base de données
    	$listeUtilisateur = $em->getRepository('NetUniversityPlatformBundle:Utilisateur')->findAll();
    	$Institut = $em->getRepository('NetUniversityPlatformBundle:Institut')->findById($InstitutId);


		$repository = $this
		  ->getDoctrine()
		  ->getManager()
		  ->getRepository('NetUniversityPlatformBundle:Roles');

    	$listroles = $repository->findBy(  array('institut' => $Institut ));

    	return $this->render('NetUniversityPlatformBundle:Institut:GestionRoles.html.twig', array('ListeUtilisateur'=> $listeUtilisateur, 'listroles'=> $listroles));

	}


}