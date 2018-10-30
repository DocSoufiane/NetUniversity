<?php
// inscriptionController.php
namespace NetUniversity\PlatformBundle\Controller;

use NetUniversity\PlatformBundle\Entity\Utilisateur;
use NetUniversity\PlatformBundle\Entity\University;
use NetUniversity\PlatformBundle\Entity\Cours;
use NetUniversity\PlatformBundle\Entity\Commentaire;
use NetUniversity\PlatformBundle\Entity\Publication;
use NetUniversity\PlatformBundle\Entity\Institut;
use NetUniversity\PlatformBundle\Entity\Departement;
use NetUniversity\PlatformBundle\Entity\Filiere;
use NetUniversity\PlatformBundle\Entity\Module;

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
use NetUniversity\PlatformBundle\Form\CommentaireType;
use NetUniversity\PlatformBundle\Form\ExamenType;
use NetUniversity\PlatformBundle\Form\TPType;
use NetUniversity\PlatformBundle\Form\TDType;

use NetUniversity\PlatformBundle\Repository\UniversityRepository;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;
use NetUniversity\PlatformBundle\Repository\UtilisateurRepository;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;


//use NetUniversity\PlatformBundle\Form\LocalisationType;


use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
//use Symfony\Component\Validator\Constraints\DateTime;


class CommentaireController extends Controller
{


	public function addAction(Request $request, $CoursId)
	{	
		if(!$this->getuser()){
				echo "<a href=\"/login\" class=\"btn btn-default btn-flat\">Se connecter pour commenter</a>";
		}
		

		$id = $request->get('CoursId');

	    $Commentaire = New Commentaire();
	    $form   = $this->get('form.factory')->create(CommentaireType::class, $Commentaire);

	    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
		    	$date = new \DateTime();
	  			$Commentaire->setdateDuComment($date);
				    
			    $user = $this->getUser();
				$Commentaire->setUtilisateur($user);
		     	$em = $this->getDoctrine()->getManager();
		      	$em->persist($Commentaire);
		      	$em->flush();

		      $request->getSession()->getFlashBag()->add('notice', 'Commentaire bien créée.');

		      return $this->redirectToRoute('ViewCours', array('CoursId' => $CoursId)); 
		}
	
	 return $this->render('NetUniversityPlatformBundle:Commentaire:add.html.twig', array('form' => $form->createView(), 'CoursId'=> $id));
	}


public function listeAction($CoursId)
	{
		  $em = $this->getDoctrine()->getManager();
		    // La méthode findAll retourne toutes les catégories de la base de données
		  $Cours = $em->getRepository('NetUniversityPlatformBundle:Cours')->find($CoursId);
    $listeCommentaire = $Cours->getCommentaire();
    foreach ($listeCommentaire as $com){
		dump($com->getComment());
    }
//die;
return $this->render('NetUniversityPlatformBundle:Commentaire:liste.html.twig', array('listeCommentaire' => $listeCommentaire, 'CoursId'=> $CoursId));  

	}



}


?>