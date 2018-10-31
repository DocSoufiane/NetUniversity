<?php 
// forum controler
namespace NetUniversity\PlatformBundle\Controller;


use NetUniversity\PlatformBundle\Entity\Utilisateur;
use NetUniversity\PlatformBundle\Entity\University;
use NetUniversity\PlatformBundle\Entity\Cours;
use NetUniversity\PlatformBundle\Entity\Publication;
use NetUniversity\PlatformBundle\Entity\Institut;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use NetUniversity\PlatformBundle\Form\UtilisateurType;
use NetUniversity\PlatformBundle\Form\UniversityType;
use NetUniversity\PlatformBundle\Form\CoursType;
use NetUniversity\PlatformBundle\Form\InstitutType;

//use NetUniversity\PlatformBundle\Form\LocalisationType;
use NetUniversity\PlatformBundle\Repository\UniversityRepository;
use Symfony\Component\Serializer\SerializerInterface;

use Symfony\Component\HttpFoundation\JsonResponse;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


class ForumController extends Controller
{
    public function indexAction()
    {

    	$em = $this->getDoctrine()->getManager();


			// On récupère l'annonce $id
			$Classes = $em->getRepository('NetUniversityPlatformBundle:Classe')->findAll();
		 	

        //return new Response("Page de Forum !");
   	    return $this->render('NetUniversityPlatformBundle:Forum:ListeThemes.html.twig', array('Classes'=> $Classes));

    }
	public function afficheAction($SubjectId){


		if (!isset($SubjectId)) {
      		throw new NotFoundHttpException("L'institut n'existe pas.");
    		}
    	else{
		$em = $this->getDoctrine()->getManager();

		// On récupère l'annonce $id
		$Sujet = $em->getRepository('NetUniversityPlatformBundle:Institut')->find($SubjectId);

			if (null === $Sujet) {
			  throw new NotFoundHttpException("Le Departement d'id ".$SubjectId." n'existe pas.");
			}

    		return $this->render('NetUniversityPlatformBundle:Forum:view.html.twig', array('Sujet'=> $Sujet));
		}
	
	}

}

?>