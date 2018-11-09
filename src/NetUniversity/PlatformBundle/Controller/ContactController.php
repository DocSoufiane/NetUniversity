<?php

namespace NetUniversity\PlatformBundle\Controller;

use NetUniversity\PlatformBundle\Entity\Utilisateur;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;



use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;
use NetUniversity\PlatformBundle\Repository\UtilisateurRepository;
use NetUniversity\PlatformBundle\Repository\ContactsRepository;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;


//use NetUniversity\PlatformBundle\Form\LocalisationType;


use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
//use Symfony\Component\Validator\Constraints\DateTime;


class ContactController extends Controller
{
	public function DemanderAction(Request $request)
	{		
				    // On vérifie que l'utilisateur dispose bien du rôle ROLE_AUTEUR
			    if (!$this->get('security.authorization_checker')->isGranted('ROLE_PROF')) {
			      // Sinon on déclenche une exception « Accès interdit »
			      throw new AccessDeniedException('Accès limité aux Profs.');
			    }

		    $Cours = New Cours();
		    $form   = $this->get('form.factory')->create(CoursType::class, $Cours);

		    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
		    	$date = new \DateTime();
      			$Cours->setDateDeCreation($date);
      			$repository = $this->getDoctrine()
			      ->getManager()
			      ->getRepository('NetUniversityPlatformBundle:Module');
			    $Module = $repository->find(2);
			    $Module->addCour($Cours);
			    $Cours->addModule($Module);
      			//$Cours->setModule($Module);
      			$Cours->upload();

			    
			    $user = $this->getUser();
			    $Cours->setUtilisateur($user);

		     	$em = $this->getDoctrine()->getManager();
		      	$em->persist($Cours);
		      	$em->persist($Module);
		      	$em->flush();

		      $request->getSession()->getFlashBag()->add('notice', 'Département bien créée.');

		      return $this->redirectToRoute('ViewCours', array('CoursId' => $Cours->getid()));  

			}

	    return $this->render('NetUniversityPlatformBundle:Cours:add.html.twig', array('form' => $form->createView(),));

	}
	public function ValiderAction(Request $request)
	{		
				    // On vérifie que l'utilisateur dispose bien du rôle ROLE_AUTEUR
			    if (!$this->get('security.authorization_checker')->isGranted('ROLE_PROF')) {
			      // Sinon on déclenche une exception « Accès interdit »
			      throw new AccessDeniedException('Accès limité aux Profs.');
			    }

		    $Cours = New Cours();
		    $form   = $this->get('form.factory')->create(CoursType::class, $Cours);

		    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
		    	$date = new \DateTime();
      			$Cours->setDateDeCreation($date);
      			$repository = $this->getDoctrine()
			      ->getManager()
			      ->getRepository('NetUniversityPlatformBundle:Module');
			    $Module = $repository->find(2);
			    $Module->addCour($Cours);
			    $Cours->addModule($Module);
      			//$Cours->setModule($Module);
      			$Cours->upload();

			    
			    $user = $this->getUser();
			    $Cours->setUtilisateur($user);

		     	$em = $this->getDoctrine()->getManager();
		      	$em->persist($Cours);
		      	$em->persist($Module);
		      	$em->flush();

		      $request->getSession()->getFlashBag()->add('notice', 'Département bien créée.');

		      return $this->redirectToRoute('ViewCours', array('CoursId' => $Cours->getid()));  

		// //////////////////////////////////////////////////////////////////
	}

	    return $this->render('NetUniversityPlatformBundle:Cours:add.html.twig', array('form' => $form->createView(),));

	}
	public function SupprimerAction(Request $request)
	{		
				    // On vérifie que l'utilisateur dispose bien du rôle ROLE_AUTEUR
			    if (!$this->get('security.authorization_checker')->isGranted('ROLE_PROF')) {
			      // Sinon on déclenche une exception « Accès interdit »
			      throw new AccessDeniedException('Accès limité aux Profs.');
			    }

		    $Cours = New Cours();
		    $form   = $this->get('form.factory')->create(CoursType::class, $Cours);

		    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
		    	$date = new \DateTime();
      			$Cours->setDateDeCreation($date);
      			$repository = $this->getDoctrine()
			      ->getManager()
			      ->getRepository('NetUniversityPlatformBundle:Module');
			    $Module = $repository->find(2);
			    $Module->addCour($Cours);
			    $Cours->addModule($Module);
      			//$Cours->setModule($Module);
      			$Cours->upload();

			    
			    $user = $this->getUser();
			    $Cours->setUtilisateur($user);

		     	$em = $this->getDoctrine()->getManager();
		      	$em->persist($Cours);
		      	$em->persist($Module);
		      	$em->flush();

		      $request->getSession()->getFlashBag()->add('notice', 'Département bien créée.');

		      return $this->redirectToRoute('ViewCours', array('CoursId' => $Cours->getid()));  

		// //////////////////////////////////////////////////////////////////
	}

	    return $this->render('NetUniversityPlatformBundle:Cours:add.html.twig', array('form' => $form->createView(),));

	}

	public function addContactsAction(Request $request)
	{


		$em = $this->getDoctrine()->getManager();

		 $Contacts = New Contacts;
		$id = $request->get('Contacts-id');
		$UserId = $request->get('User-id');
		//$Cours = $this->CoursRepository->findById($id);
	    $Validateur = $em->getRepository('NetUniversityPlatformBundle:Utilisateur')->find($id);
	    //$Demandeur = $em->getRepository('NetUniversityPlatformBundle:Utilisateur')->find($UserId);

		//$likeNEW = $Cours->getlike()+1;

	    	if ($isChecked == "true") {
	    		$Contacts->setValidateur($Validateur);
				$Contacts->setDemandeur($this->getUser());

				$em->persist($Contacts);
			} 
			elseif ($isChecked == "false") {
				$Cours->removelike($this->getUser());
			}

		$Contacts->setValidateur($Validateur);
		$Contacts->setDemandeur($this->getUser());

		$em->persist($Contacts);
		$em->flush();
				return new Response('Successfully request');

	}

	public function listeContactsAction(Request $request)
	{
			$Contacts = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('NetUniversityPlatformBundle:Contacts')
            ->findByUser($this->getUser())
          ;
			$ContactsInvitation= $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('NetUniversityPlatformBundle:Contacts')
            ->findByUserInvitation($this->getUser())
          ;
		    // La méthode findAll retourne toutes les catégories de la base de données
	   // $Contacts = $this->getUser()->getContacts();

		return $this->render('NetUniversityPlatformBundle:Contacts:liste.html.twig', array('Contacts' => $Contacts, 'ContactsInvitation' => $ContactsInvitation ));  

	}


}

?>