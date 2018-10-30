<?php
// GestionUtilisateurController.php
namespace NetUniversity\PlatformBundle\Controller;

use NetUniversity\PlatformBundle\Entity\Utilisateur;
use NetUniversity\PlatformBundle\Entity\University;
use NetUniversity\PlatformBundle\Entity\Cours;
use NetUniversity\PlatformBundle\Entity\Publication;
use NetUniversity\PlatformBundle\Entity\Institut;
use NetUniversity\PlatformBundle\Entity\Departement;
use NetUniversity\PlatformBundle\Entity\Filiere;
use NetUniversity\PlatformBundle\Entity\Module;
use NetUniversity\PlatformBundle\Entity\Recherche;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


use NetUniversity\PlatformBundle\Form\UtilisateurType;
use NetUniversity\PlatformBundle\Form\UniversityType;
use NetUniversity\PlatformBundle\Form\DepartementType;
use NetUniversity\PlatformBundle\Form\InstitutType;
use NetUniversity\PlatformBundle\Form\FiliereType;
use NetUniversity\PlatformBundle\Form\ModuleType;
use NetUniversity\PlatformBundle\Form\CoursType;
use NetUniversity\PlatformBundle\Form\ExamenType;
use NetUniversity\PlatformBundle\Form\TPType;
use NetUniversity\PlatformBundle\Form\TDType;

use NetUniversity\PlatformBundle\Repository\UniversityRepository;
use NetUniversity\PlatformBundle\Repository\ContactsRepository;
use NetUniversity\PlatformBundle\Repository\UtilisateurRepository;
use NetUniversity\PlatformBundle\Repository\RechercheRepository;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;


//use NetUniversity\PlatformBundle\Form\LocalisationType;


use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
//use Symfony\Component\Validator\Constraints\DateTime;


class GestionUtilisateurController extends Controller
{


	public function addRoleAction(Request $request)
	{
		// On vérifie que l'utilisateur dispose bien du rôle ROLE_AUTEUR
	    if (!$this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
	      // Sinon on déclenche une exception « Accès interdit »
	      throw new AccessDeniedException('Accès limité aux ADMINS.');
	    }

		$em = $this->getDoctrine()->getManager();

		$id = $request->get('Utilisateur-id');
		$isChecked = $request->get('checkbox-value');

		//$Cours = $this->CoursRepository->findById($id);
	    $Utilisateur = $em->getRepository('NetUniversityPlatformBundle:Utilisateur')->find($id);

		//$likeNEW = $Cours->getlike()+1;		
		
			
				
				$role = [];
				$role[] = $isChecked;
				$Utilisateur->setRoles($role);
			
			
		$em->flush();
		return new Response('Role updated successfully');


	}

	public function removeRoleAction(Request $request)
	{
		// On vérifie que l'utilisateur dispose bien du rôle ROLE_AUTEUR
	    if (!$this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
	      // Sinon on déclenche une exception « Accès interdit »
	      throw new AccessDeniedException('Accès limité aux ADMINS.');
	    }

		$role = array('');
 
		$this->getUser()->setRole($role);
	}


	public function GestionRoleAction(Request $request)
	{
		$em = $this->getDoctrine()->getManager();
							    // On vérifie que l'utilisateur dispose bien du rôle ROLE_AUTEUR
			    if (!$this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
			      // Sinon on déclenche une exception « Accès interdit »
			      throw new AccessDeniedException('Accès limité aux ADMINS.');
			    }

		// La méthode findAll retourne toutes les catégories de la base de données
    	$listeUtilisateur = $em->getRepository('NetUniversityPlatformBundle:Utilisateur')->findAll();

    	return $this->render('NetUniversityPlatformBundle:GestionUtilisateur:roles.html.twig', array('ListeUtilisateur'=> $listeUtilisateur));

	}


}


?>