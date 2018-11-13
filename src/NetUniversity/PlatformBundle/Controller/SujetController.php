<?php
// inscriptionController.php
namespace NetUniversity\PlatformBundle\Controller;

use NetUniversity\PlatformBundle\Entity\Utilisateur;

use NetUniversity\PlatformBundle\Entity\Commentaire;
use NetUniversity\PlatformBundle\Entity\Sujet;

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


	public function addCommentAction(Request $request, $SujetId, $commentMere)
	{	
		if(!$this->getuser()){
				echo "<a href=\"/login\" class=\"btn btn-default btn-flat\">Se connecter pour commenter</a>";
		}

			    $em = $this->getDoctrine()->getManager();
  		$Sujet = $em->getRepository('NetUniversityPlatformBundle:Sujet')->find($SujetId);
		if($commentMere){

	 	return $this->render('NetUniversityPlatformBundle:Forum:addComment.html.twig', array('Sujet' => $Sujet, 'commentMere'=> $commentMere));
		}
		else{
				 	return $this->render('NetUniversityPlatformBundle:Forum:addComment.html.twig', array('Sujet' => $Sujet, 'commentMere'=> 0));
		}
	}

	public function addCommentAJAXAction(Request $request)
	{	
		if(!$this->getuser()){
				echo "<a href=\"/login\" class=\"btn btn-default btn-flat\">Se connecter pour commenter</a>";
		}

		//dump('je suis la');
	    if ($request->get('Sujet-id')) {

			$id = $request->get('Sujet-id');
			$isChecked = $request->get('checkbox-value');
			$CommentMere= $request->get('CommentMere');

		    $Commentaire = New Commentaire();
		    $em = $this->getDoctrine()->getManager();
	  		$Sujet = $em->getRepository('NetUniversityPlatformBundle:Sujet')->find($id);

	  		if($CommentMere != 0){

	  			$CommentMereOB = $em->getRepository('NetUniversityPlatformBundle:Commentaire')->find($CommentMere);

	  			$Commentaire->setCommentaireMere($CommentMereOB);
	  		}
	    	$date = new \DateTime();
  			$Commentaire->setdateDuComment($date);
			    
		    $user = $this->getUser();
			$Commentaire->setUtilisateur($user);
			$Commentaire->setSujet($Sujet);
			$Commentaire->setComment($isChecked);
	     	$em = $this->getDoctrine()->getManager();
	      	$em->persist($Commentaire);
	      	$em->flush();


	     
			$request->getSession()->getFlashBag()->add('notice', 'Commentaire bien créée.');

			$OUT = $this->redirectToRoute('ListeCommentairesSujet', array('SujetId' => $Sujet->getId())); 
		return new Response($OUT);
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
return $this->render('NetUniversityPlatformBundle:Forum:listeComment.html.twig', array('listeCommentaire' => $listeCommentaire, 'SujetId'=> $SujetId));  

	}

}


?>