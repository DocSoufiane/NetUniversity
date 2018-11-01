<?php

namespace NetUniversity\PlatformBundle\Controller;

use NetUniversity\PlatformBundle\Entity\Utilisateur;
use NetUniversity\PlatformBundle\Entity\Classe;
use NetUniversity\PlatformBundle\Entity\Filiere;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;



use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use NetUniversity\PlatformBundle\Form\ClasseType;
use NetUniversity\PlatformBundle\Form\FiliereType;
//use NetUniversity\PlatformBundle\Form\FiliereType;


use Doctrine\ORM\EntityRepository;
use NetUniversity\PlatformBundle\Repository\UtilisateurRepository;
use NetUniversity\PlatformBundle\Repository\ContactsRepository;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;


//use NetUniversity\PlatformBundle\Form\LocalisationType;


use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
//use Symfony\Component\Validator\Constraints\DateTime;


class ClasseController extends Controller
{


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

	public function addAction(Request $request)
	{
		$Classe = New Classe();
		$id = $this->getUser()->getId();
	    $formBuilder = $this->get('form.factory')->createBuilder(ClasseType::class, $Classe);

	    $form = $formBuilder->getForm();

	    if ($request->isMethod('POST')) {

			$form->handleRequest($request);
			if ($form->isSubmitted() && $form->isValid()) {
				$date = new \DateTime();
				$Classe->setdateDeCreation($date);
				$Classe->setOwner($this->getUser());
				$em = $this->getDoctrine()->getManager();

				$em->persist($Classe);
				$em->flush();

				$request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');

				return $this->redirectToRoute('viewClasse', array('ClasseId'=> $Classe->getId()));
			}
		}
		 return $this->render('NetUniversityPlatformBundle:Classe:Add.html.twig', array('form' => $form->createView()));
	}

	public function GestionEtudiants(Request $request){
		
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

	public function viewAction(Request $request, $ClasseId)
	{
		$em = $this->getDoctrine()->getManager();

	    $Classe = $em->getRepository('NetUniversityPlatformBundle:Classe')->find($ClasseId);

		return $this->render('NetUniversityPlatformBundle:Classe:view.html.twig', array('Classe' => $Classe));  

	}

}

?>