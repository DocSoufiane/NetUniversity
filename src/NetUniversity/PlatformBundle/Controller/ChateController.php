<?php
// inscriptionController.php
namespace NetUniversity\PlatformBundle\Controller;

use NetUniversity\PlatformBundle\Entity\Utilisateur;
use NetUniversity\PlatformBundle\Entity\Chate;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Doctrine\ORM\EntityRepository;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;


//use NetUniversity\PlatformBundle\Form\LocalisationType;


use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
//use Symfony\Component\Validator\Constraints\DateTime;


class ChateController extends Controller
{


	public function indexAction(Request $request, $UserId)
	{
	    			
	    if ( $this->getUser() ) {

			return $this->render('NetUniversityPlatformBundle:Chate:index.html.twig', array('User' => $this->getUser() ));  

		}

		return $this->redirectToRoute('index');  
	}

	public function ConversationAction(Request $request, $UserId){

	    if ( $this->getUser() ) {

			$em = $this->getDoctrine()->getManager();
	  		$Recepteur = $em->getRepository('NetUniversityPlatformBundle:Utilisateur')->find($UserId);
	  		$Emeteur = $this->getUser();
			return $this->render('NetUniversityPlatformBundle:Chate:chate.html.twig', array('Emeteur' => $this->getUser(), 'Recepteur'=> $Recepteur ));  

		}

	}

	public function AddMessageAction(Request $request)
	{	
		if(!$this->getuser()){
				echo "<a href=\"/login\" class=\"btn btn-default btn-flat\">Se connecter pour commenter</a>";
		}

		//dump('je suis la');
	    if ($request->get('idEmeteur') and $request->get('message') and $request->get('idRecepteur')) {

			$idEmeteur = $request->get('idEmeteur');
			$message = $request->get('message');
			$idRecepteur= $request->get('idRecepteur');

		    $Chate = New Chate();
		    $em = $this->getDoctrine()->getManager();
	  		$Emeteur = $em->getRepository('NetUniversityPlatformBundle:Utilisateur')->find($idEmeteur);
	  		$Recepteur = $em->getRepository('NetUniversityPlatformBundle:Utilisateur')->find($idRecepteur);

	  		if($Emeteur != $this->getUser()){

				return 0;
	  		}

	    	$date = new \DateTime();
  			$Chate->setdate($date);
			    
			$Chate->setemeteur($Emeteur);
			$Chate->setrecepteur($Recepteur);
			$Chate->setmessage($message);
	     	$em = $this->getDoctrine()->getManager();
	      	$em->persist($Chate);
	      	$em->flush();


	     
			$request->getSession()->getFlashBag()->add('notice', 'message de chate bien créée.');

			$OUT = "Done"; 
		return new Response($OUT);
		}

	}

}