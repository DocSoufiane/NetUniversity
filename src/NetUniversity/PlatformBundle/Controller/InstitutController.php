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

    	return $this->render('NetUniversityPlatformBundle:Institut:GestionRoles.html.twig', array('ListeUtilisateur'=> $listeUtilisateur, 'listroles'=> $listroles, 'InstitutId'=> $InstitutId));

	}
	public function checkMailAddresseAction(Request $request){
		  $em = $this->getDoctrine()->getManager();

		  $ListeAddresses = $em->getRepository('NetUniversityPlatformBundle:Utilisateur')->findAll();
		  //dump($a);die;
		  //$a[]= $a->getArrayResult();



			// Array with names
		foreach($ListeAddresses as $mail){
			$a[] = $mail->getemail();
		}


		// get the q parameter from URL
		$q = $_REQUEST["q"];

		$hint = "";

		// lookup all hints from array if $q is different from "" 
		if ($q !== "") {
		    $q = strtolower($q);
		    $len=strlen($q);
		    foreach($a as $name) {
		        if (stristr($q, substr($name, 0, $len))) {
		            if ($hint === "") {
		                $hint = $name;
		            } else {
		                $hint .= ", $name";
		            }
		        }
		    }
		}

		// Output "no suggestion" if no hint was found or output correct values 
		//echo $hint === "" ? "no suggestion" : $hint;
		return new Response($hint);
	}


public function AddInstitutAction(Request $request)
	{
		/*$user=$this->getUser();//dump($user->getUniversity());  die; 
		$univs=$user->getUniversity(); dump($univs->getName());  die; 
		foreach($univs as $univ ) {
		    	# code...
		    	dump($univ->getName());
		    }
		    die; */
						    // On vérifie que l'utilisateur dispose bien du rôle ROLE_AUTEUR
			    if (!$this->get('security.authorization_checker')->isGranted('ROLE_DIRECTEUR')) {
			      // Sinon on déclenche une exception « Accès interdit »
			      throw new AccessDeniedException('Accès limité aux Doyen.');
			    }
			    


		  $em = $this->getDoctrine()->getManager();
			$InstitutId = $_REQUEST["q"];
		  $Institut = $em->getRepository('NetUniversityPlatformBundle:Institut')->find($InstitutId);


			    $role= $Institut->getRoles();
			   // dump($Institut); die;
			    $checke= $em->getRepository('NetUniversityPlatformBundle:Roles')->Check($Institut, $this->getUser());
			    
			    $user=$this->getUser();
				//$univs=$user->getUniversity();
			    	
		    $institut = New Institut();
		    $form   = $this->get('form.factory')->create(InstitutType::class, $institut);

			    foreach ($checke as $key) {
			    	# code...
			    if($key->getrole()=="Ecrire"){
			    	echo "Vous pouvez editer l'institut ". $key->getInstitut()->getNom();  
							  

		
		    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
		    	$date = new \DateTime();
      			$institut->setdateCreation($date);
      			$institut->setUniversity($user->getUniversity());
      			$institut->upload();

			    
			    $user = $this->getUser();
			    $institut->setUtilisateur($user);

		     	$em = $this->getDoctrine()->getManager();
		      	$em->persist($institut);
		      	$em->flush();

		      $request->getSession()->getFlashBag()->add('notice', 'Département bien créée.');

		      return $this->redirectToRoute('ViewInstitut', array('InstitutId' => $institut->getid()));  

					// //////////////////////////////////////////////////////////////////
					
				    $em = $this->getDoctrine()->getManager();
				    $em->persist($institut);
				    $em->flush();

				    if ($request->isMethod('POST')) {
				      $request->getSession()->getFlashBag()->add('notice', 'Département bien enregistrée.');

				      return $this->redirectToRoute('user', array('id' => $user->getId()));
				    }
				}

			}
			else{ echo "vous n'avez pas le droit!";	}

	   		return $this->render('NetUniversityPlatformBundle:Institut:add.html.twig', array('form' => $form->createView(),));			    	
	   			


			}


	}


}