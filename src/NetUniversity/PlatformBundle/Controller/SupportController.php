<?php
// inscriptionController.php
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

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


use NetUniversity\PlatformBundle\Form\UtilisateurType;
use NetUniversity\PlatformBundle\Form\ModifUtilisateurType;
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


class SupportController extends Controller
{
	public function GestionPrivilegeAction(Request $request, $CoursId){

	    if (!$this->get('security.authorization_checker')->isGranted('ROLE_PROF')) {
	      // Sinon on déclenche une exception « Accès interdit »
	      throw new AccessDeniedException('Accès limité aux Profs.');
	    }
	    $em = $this->getDoctrine()->getManager();
    	$Support = $em->getRepository('NetUniversityPlatformBundle:Cours')->findOneById($CoursId);
    	$ListeClasses = $em->getRepository('NetUniversityPlatformBundle:Classe')->findAll();

    	//$user->getProducts()->contains($product)
    	//$ListeClasses->contains($Support);
    	return $this->render('NetUniversityPlatformBundle:Support:GesPrivilege.html.twig', array('ListeClasses'=> $ListeClasses, 'Support'=> $Support));

	}
	


	public function addPrivilegeAction(Request $request)
	{
	    if (!$this->get('security.authorization_checker')->isGranted('ROLE_PROF')) {
	      // Sinon on déclenche une exception « Accès interdit »
	      throw new AccessDeniedException('Accès limité aux Profs.');
	    }

		$em = $this->getDoctrine()->getManager();

		$id = $request->get('Classe-id');
		$Support_id = $request->get('Support-id');
		$isChecked = $request->get('checkbox-value');

		//$Cours = $this->CoursRepository->findById($id);
	    $Classe = $em->getRepository('NetUniversityPlatformBundle:Classe')->find($id);
	    $Support = $em->getRepository('NetUniversityPlatformBundle:Cours')->find($Support_id);

		//$likeNEW = $Cours->getlike()+1;		
		
			
				
			if ($isChecked == "true") {
				DUMP('true');
				$Classe->addSupport($Support);
			} 
			elseif ($isChecked == "false") {
				dump('false');
				$Classe->removeSupport($Support);
			}
			//die;

			
		$em->flush();
		return new Response('Role updated successfully');


	}

	public function mylisteCoursEditionAction(Request $request)
	{
		$em = $this->getDoctrine()->getManager();
		    // La méthode findAll retourne toutes les catégories de la base de données
	    $listeCours = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('NetUniversityPlatformBundle:Cours')
            ->findByEditor($this->getUser())
          ;

		return $this->render('NetUniversityPlatformBundle:Cours:liste.html.twig', array('listeCours' => $listeCours));  

	}

	public function afficheCours2Action($CoursId)
	{

		if (!isset($CoursId)) {
      		throw new NotFoundHttpException("Le Filière n'existe pas.");
    		}
    	else{
			$em = $this->getDoctrine()->getManager();


			// On récupère l'annonce $id
			$Cours = $em->getRepository('NetUniversityPlatformBundle:Cours')->find($CoursId);
		 	$Prof=$Cours->getUtilisateur();

			if (null === $Cours) {
			  throw new NotFoundHttpException("La Cours d'id ".$CoursId." n'existe pas.");
			}
			
          $like=0;
          foreach ($Cours->getLike() as $User){
				if($this->getUser()== $User){
						$like=1;
				}         
			}
			//dump($Prof);die;
    		return $this->render('NetUniversityPlatformBundle:Cours:view.html.twig', array('Cours'=> $Cours, 'Prof'=> $Prof, 'like'=> $like)); //array('Module'=> $Module, 'Support'=> $Support)
		}
	}

























////////////////////////////////////////////////////:



	public function CreerCoursAction(Request $request)
	{
		$Cours = New Cours();

		$id = $request->get('UserId');

		// On crée le FormBuilder grâce au service form factory
	    $formBuilder = $this->get('form.factory')->createBuilder(CoursType::class, $Cours);

	    // Pour l'instant, pas de candidatures, catégories, etc., on les gérera plus tard

	    // À partir du formBuilder, on génère le formulaire
	    $form = $formBuilder->getForm();


	    /////////////////////////////////////////////////////

    // Si la requête est en POST
    if ($request->isMethod('POST')) {
      // On fait le lien Requête <-> Formulaire
      // À partir de maintenant, la variable $advert contient les valeurs entrées dans le formulaire par le visiteur
      $form->handleRequest($request);

      // On vérifie que les valeurs entrées sont correctes
      // (Nous verrons la validation des objets en détail dans le prochain chapitre)
      if ($form->isSubmitted() && $form->isValid()) {
        // On enregistre notre objet $advert dans la base de données, par exemple
        $em = $this->getDoctrine()->getManager();
       // $localisation = $em->getRepository('NetUniversityPlatformBundle:Localisation')->find($request->get('Location'););
         //$utilisateur->addCategory($localisation);
        $em->persist($Cours);
        $em->flush();

        $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');

        // On redirige vers la page de visualisation de l'annonce nouvellement créée
        return $this->redirectToRoute('CreatCours', array());
      }
	}
	 return $this->render('NetUniversityPlatformBundle:Cours:Form.html.twig', array('form' => $form->createView(), 'UserId'=> $id));
}



public function AddCoursAction(Request $request)
	{		
				    // On vérifie que l'utilisateur dispose bien du rôle ROLE_AUTEUR
			    if (!$this->get('security.authorization_checker')->isGranted('ROLE_PROF')) {
			      // Sinon on déclenche une exception « Accès interdit »
			      throw new AccessDeniedException('Accès limité aux Profs.');
			    }

		    $Cours = New Cours();
		    $Recherche = New Recherche();
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
			  
			    $user = $this->getUser();
			    $Cours->setUtilisateur($user);
			    $motCle= $Cours->getNom().' '.$Cours->getUtilisateur();
			    $Recherche->setMotCle($motCle);
			    //$Cours->setModule($Module);
      			$Cours->upload();

		     	$em = $this->getDoctrine()->getManager();
		     	$em->persist($Recherche);
		     	$Cours->setRecherche($Recherche);
		      	$em->persist($Cours);
		      	$em->persist($Module);
		      	$em->flush();

		      $request->getSession()->getFlashBag()->add('notice', 'Département bien créée.');

		      return $this->redirectToRoute('ViewCours', array('CoursId' => $Cours->getid()));  

		// //////////////////////////////////////////////////////////////////
	}

	    return $this->render('NetUniversityPlatformBundle:Cours:add.html.twig', array('form' => $form->createView(),));

	}


public function AddTDAction(Request $request)
	{
					    // On vérifie que l'utilisateur dispose bien du rôle ROLE_AUTEUR
			    if (!$this->get('security.authorization_checker')->isGranted('ROLE_PROF')) {
			      // Sinon on déclenche une exception « Accès interdit »
			      throw new AccessDeniedException('Accès limité aux Profs.');
			    }
		    $TD = New TD();
		    $form   = $this->get('form.factory')->create(TDType::class, $TD);

		    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
		    	$date = new \DateTime();
      			$TD->setdateCreation($date);

			    $repository = $this->getDoctrine()
			      ->getManager()
			      ->getRepository('NetUniversityPlatformBundle:Utilisateur');
			    $user = $repository->find(12);
			    $TD->setUtilisateur($user);

		     	$em = $this->getDoctrine()->getManager();
		      	$em->persist($TD);
		      	$em->flush();

		      $request->getSession()->getFlashBag()->add('notice', 'Département bien créée.');

		      return $this->redirectToRoute('ViewInstitut', array('TDId' => $TD->getid()));  

		// //////////////////////////////////////////////////////////////////
		
	    $em = $this->getDoctrine()->getManager();
	    $em->persist($TD);
	    $em->flush();

	    if ($request->isMethod('POST')) {
	      $request->getSession()->getFlashBag()->add('notice', 'TD bien enregistrée.');

	      return $this->redirectToRoute('user', array('id' => $user->getId()));
	    }
	}

	    return $this->render('NetUniversityPlatformBundle:TD:add.html.twig', array('form' => $form->createView(),));

	}


	public function likeCoursAction(Request $request)
	{
		    $em = $this->getDoctrine()->getManager();

		$id = $request->get('Cours-id');
		$isChecked = $request->get('checkbox-value');
		//$Cours = $this->CoursRepository->findById($id);
	    $Cours = $em->getRepository('NetUniversityPlatformBundle:Cours')->find($id);

		//$likeNEW = $Cours->getlike()+1;
		



		
			if ($isChecked == "true") {
				$Cours->addlike($this->getUser());
			} 
			elseif ($isChecked == "false") {
				$Cours->removelike($this->getUser());
			}
		
		$em->flush();


	}


	public function afficheCoursAction($CoursId)
	{

		if (!isset($CoursId)) {
      		throw new NotFoundHttpException("Le Filière n'existe pas.");
    		}
    	else{
			$em = $this->getDoctrine()->getManager();


			// On récupère l'annonce $id
			$Cours = $em->getRepository('NetUniversityPlatformBundle:Cours')->find($CoursId);
		 	$Prof=$Cours->getUtilisateur();

			if (null === $Cours) {
			  throw new NotFoundHttpException("La Cours d'id ".$CoursId." n'existe pas.");
			}
			
          $like=0;
          foreach ($Cours->getLike() as $User){
				if($this->getUser()== $User){
						$like=1;
				}         
			}
			//dump($Prof);die;
    		return $this->render('NetUniversityPlatformBundle:Cours:view.html.twig', array('Cours'=> $Cours, 'Prof'=> $Prof, 'like'=> $like)); //array('Module'=> $Module, 'Support'=> $Support)
		}
	}



	public function GestionComptAction(){
		if($this->getUser()){
			// Récupération d'une annonce déjà existante, d'id $id.
			$Utilisateur = New Utilisateur();
	//	    $form   = $this->get('form.factory')->create(UtilisateurType::class, $user);
//    	    return $this->render('NetUniversityPlatformBundle:Utilisateur:add.html.twig', array('form' => $form->createView(),));

			$Utilisateur = $this->getDoctrine()
			  ->getManager()
			  ->getRepository('NetUniversityPlatformBundle:Utilisateur')
			  ->find($this->getUser()->getId())
			;

			// Et on construit le formBuilder avec cette instance de l'annonce, comme précédemment
			$form = $this->get('form.factory')->create(ModifUtilisateurType::class, $Utilisateur);

			// N'oubliez pas d'ajouter les champs comme précédemment avec la méthode ->add()
			return $this->render('NetUniversityPlatformBundle:Utilisateur:SetAccount.html.twig', array('form' => $form->createView(),));

		}

	}



}


?>