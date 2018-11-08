<?php
// inscriptionController.php
namespace NetUniversity\PlatformBundle\Controller;

use NetUniversity\PlatformBundle\Entity\Utilisateur;

use NetUniversity\PlatformBundle\Entity\Commentaire;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;



use NetUniversity\PlatformBundle\Form\UtilisateurType;
use NetUniversity\PlatformBundle\Form\CommentaireType;

use NetUniversity\PlatformBundle\Repository\UniversityRepository;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;
use NetUniversity\PlatformBundle\Repository\UtilisateurRepository;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;


//use NetUniversity\PlatformBundle\Form\LocalisationType;


use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
//use Symfony\Component\Validator\Constraints\DateTime;


class SujetController extends Controller
{


	public function addCommentAction(Request $request, $SujetId)
	{	
		if(!$this->getuser()){
				echo "<a href=\"/login\" class=\"btn btn-default btn-flat\">Se connecter pour commenter</a>";
		}
		
	    $em = $this->getDoctrine()->getManager();
  		$Sujet = $em->getRepository('NetUniversityPlatformBundle:Sujet')->find($SujetId);
	
	 return $this->render('NetUniversityPlatformBundle:Commentaire:add.html.twig', array('Sujet' => $Sujet));
	}

	public function addCommentAJAXAction(Request $request)
	{	
		if(!$this->getuser()){
				echo "<a href=\"/login\" class=\"btn btn-default btn-flat\">Se connecter pour commenter</a>";
		}
		



		dump('je suis la');
	    if ($request->get('Sujet-id')) {

			$id = $request->get('Sujet-id');
			$isChecked = $request->get('checkbox-value');

		    $Commentaire = New Commentaire();
		    $em = $this->getDoctrine()->getManager();
	  		$Sujet = $em->getRepository('NetUniversityPlatformBundle:Sujet')->find($id);


	    	$date = new \DateTime();
  			$Commentaire->setdateDuComment($date);
			    
		    $user = $this->getUser();
			$Commentaire->setUtilisateur($user);
			$Commentaire->setSujet($Sujet);
			$Commentaire->setComment($isChecked);
	     	$em = $this->getDoctrine()->getManager();
	      	$em->persist($Commentaire);
	      	$em->flush();
	      	dump($Commentaire); die;

			$request->getSession()->getFlashBag()->add('notice', 'Commentaire bien créée.');

			return $this->redirectToRoute('ForumSujet', array('SujetId' => $SujetId)); 
		
		}

	}

public function listeCommentAction($SujetId)
	{
		  $em = $this->getDoctrine()->getManager();
		    // La méthode findAll retourne toutes les catégories de la base de données
		  $Sujet = $em->getRepository('NetUniversityPlatformBundle:Sujet')->find($SujetId);
		  $listeCommentaire = $em->getRepository('NetUniversityPlatformBundle:Commentaire')->findBy(array('sujet' => $Sujet));

    //foreach ($listeCommentaire as $com){
	//	dump($com->getComment());
   // }
//die;
return $this->render('NetUniversityPlatformBundle:Commentaire:liste.html.twig', array('listeCommentaire' => $listeCommentaire, 'CoursId'=> $SujetId));  

	}

}


?>