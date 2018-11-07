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




	public function ViewSubjectAction(Request $request, $Id)
	{
		if (!isset($Id)) {
      		throw new NotFoundHttpException("Le sujet n'existe pas.");
    		}
    	else{
		$em = $this->getDoctrine()->getManager();

		// On récupère l'annonce $id
		$Sujet = $em->getRepository('NetUniversityPlatformBundle:Sujet')->find($Id);

			if (null === $Sujet) {
			  throw new NotFoundHttpException("Le Departement d'id ".$Id." n'existe pas.");
			}

    		return $this->render('NetUniversityPlatformBundle:Forum:view.html.twig', array('Sujet'=> $Sujet));
		}
	}
	public function ViewClasseAction(Request $request, $Id)
	{

    	$em = $this->getDoctrine()->getManager();


			// On récupère l'annonce $id
			$Classe = $em->getRepository('NetUniversityPlatformBundle:Classe')->find($Id);
		 	
			$ListeSujets=$Classe->getSujet();
			//return new Response("Page de Forum !");
   	    return $this->render('NetUniversityPlatformBundle:Forum:Liste.html.twig', array('ListeSujets'=> $ListeSujets));

   	}
	public function ViewFiliereAction($value='')
	{
		# code...
	}
	public function ViewDeppartementAction($value='')
	{
		# code...
	}
	public function ViewInstitutAction($value='')
	{
		# code...
	}
	public function ViewUniversityAction($value='')
	{
		# code...
	}

	public function afficheAction($SubjectId){




	}



}

?>