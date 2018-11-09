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


class UtilisateurController extends Controller
{

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



	public function addAction(Request $request, UserPasswordEncoderInterface $passwordEncoder)
	{
			
		if($this->getUser()){
			return $this->redirectToRoute('fos_user_security_logout');
		}


			$passwordEncoder = $this->get('security.password_encoder');
		    $userF = New Utilisateur();
		    $form   = $this->get('form.factory')->create(UtilisateurType::class, $userF);

		    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {

				$role = [];
				$role[] = "ROLE_ETUDIANT";
				

			      $userManager = $this->get('fos_user.user_manager');

			      // Or you can use the doctrine entity manager if you want instead the fosuser manager
			      // to find 
			      //$em = $this->getDoctrine()->getManager();
			      //$usersRepository = $em->getRepository("mybundleuserBundle:User");
			      // or use directly the namespace and the name of the class 
			      // $usersRepository = $em->getRepository("mybundle\userBundle\Entity\User");
			      //$email_exist = $usersRepository->findOneBy(array('email' => $email));
			      
			      $email_exist = $userManager->findUserByEmail($form->getData()->getemail());

			      // Check if the user exists to prevent Integrity constraint violation error in the insertion
			      if($email_exist){
			          return false;
			      }

			      $user = $userManager->createUser();
			      $useF = $userManager->createUser();

			      	$userF->setUsername($form->getData()->getusername());
			      	$userF->setEmail($form->getData()->getemail());
			      	$userF->setEmailCanonical($form->getData()->getemail());
			      	$userF->setEnabled(1);
			      	$userF->setPlainPassword($form->getData()->getpassword());
				    $date = new \DateTime();
	      			$userF->setDateDinscription($date);
	      			$userF->setRoles($role);
	      			$userF->upload();
	      						      $userManager->updateUser($userF);
			     	$em = $this->getDoctrine()->getManager();
			      	$em->persist($userF);
			      	//$em->persist($user);
			      	$em->flush();

			      $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');

			      return $this->redirectToRoute('utilisateurview', array('UserId' => $userF->getId()));

		/*

		    // On crée un objet Utilisateur
	   $user = New Utilisateur();

	    // On crée le FormBuilder grâce au service form factory
	    $formBuilder = $this->get('form.factory')->createBuilder(FormType::class, $user);

	    // On ajoute les champs de l'entité que l'on veut à notre formulaire
	    $formBuilder
	      ->add('Prenom',     TextType::class)
	      ->add('Nom',     TextType::class)
	      ->add('Mail',   EmailType::class)
	      ->add('Passe',    PasswordType::class)
	      ->add('Type',    TextType::class)
	      ->add('Age',    NumberType::class)
	    //  ->add('Localisation',    NumberType::class)
	      //->add('published', CheckboxType::class)
	      ->add('save',      SubmitType::class)
	    ;
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
      if ($form->isValid()) {
      	$date = new \DateTime();
      	$user->setDernierevisite($date);
      	$user->setDateDinscription($date);

        // On enregistre notre objet $advert dans la base de données, par exemple
        $em = $this->getDoctrine()->getManager();
       // $localisation = $em->getRepository('NetUniversityPlatformBundle:Localisation')->find($request->get('Location'););
         //$utilisateur->addCategory($localisation);
        $em->persist($user);
        $em->flush();

        $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');

        // On redirige vers la page de visualisation de l'annonce nouvellement créée
        return $this->redirectToRoute('utilisateurview', array('UserId' => $user->getId()));
      }

      */

    }

    // À ce stade, le formulaire n'est pas valide car :
    // - Soit la requête est de type GET, donc le visiteur vient d'arriver sur la page et veut voir le formulaire
    // - Soit la requête est de type POST, mais le formulaire contient des valeurs invalides, donc on l'affiche de nouveau

    /////////////////////////////////////////////////////

	    // On passe la méthode createView() du formulaire à la vue
	    // afin qu'elle puisse afficher le formulaire toute seule
	   // return $this->render('OCPlatformBundle:Advert:add.html.twig', array(
	    //  'form' => $form->createView(),));
	    	    return $this->render('NetUniversityPlatformBundle:Utilisateur:add.html.twig', array('form' => $form->createView(),));
		// //////////////////////////////////////////////////////////////////
		//$user = New Utilisateur();
		//$user->setNom('BERJAMY');
		//$user->setPrenom('Soufiane');
		//$user->setMail('docsoufiane1@gmail.com');
		//$user->setPasse('yeswecan');
		//$user->setType('admin');
		//$user->setAge('24');
		//$user->setLocation('Casablanca');
		//$user->setDateDinscription(date("2018-09-20 00:00:00"));
		//$date = new \DateTime('2018-09-20 00:00:00');
		//$user->setDateDinscription($date);
		//$user->setDernierevisite(Now());

		//$date = new \DateTime('2018-09-20 00:00:00');
		//$user->setDernierevisite($date);




			 // On récupère l'EntityManager
	    $em = $this->getDoctrine()->getManager();

	        // Étape 1 : On « persiste » l'entité
	    $em->persist($user);

	    // Étape 2 : On « flush » tout ce qui a été persisté avant
	    $em->flush();

	    // Reste de la méthode qu'on avait déjà écrit
	    if ($request->isMethod('POST')) {
	      $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');

	      // Puis on redirige vers la page de visualisation de cettte annonce
	      return $this->redirectToRoute('user', array('id' => $user->getId()));
	    }

	    // Si on n'est pas en POST, alors on affiche le formulaire
	    return $this->render('NetUniversityPlatformBundle:Utilisateur:add.html.twig', array('user' => $user->getNom()));


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
      			$Cours->setderniereModif($date);
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
		     	$em->persist($Cours);
			    $Recherche->setcours($Cours);

		     	$em->persist($Recherche);
		     	
		      	
		      	$em->persist($Module);
		      	$em->flush();

		      $request->getSession()->getFlashBag()->add('notice', 'Département bien créée.');

		      return $this->redirectToRoute('ViewCours', array('CoursId' => $Cours->getid()));  

		// //////////////////////////////////////////////////////////////////
	}

	    return $this->render('NetUniversityPlatformBundle:Cours:add.html.twig', array('form' => $form->createView(),));

	}

public function AddExamenAction(Request $request)
	{		
				    // On vérifie que l'utilisateur dispose bien du rôle ROLE_AUTEUR
			    if (!$this->get('security.authorization_checker')->isGranted('ROLE_PROF')) {
			      // Sinon on déclenche une exception « Accès interdit »
			      throw new AccessDeniedException('Accès limité aux Profs.');
			    }

		    $Examen = New Examen();
		    $form   = $this->get('form.factory')->create(ExamenType::class, $Examen);

		    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
		    	$date = new \DateTime();
      			$Examen->setdateCreation($date);

			    $repository = $this->getDoctrine()
			      ->getManager()
			      ->getRepository('NetUniversityPlatformBundle:Utilisateur');
			    $user = $repository->find(12);
			    $Examen->setUtilisateur($user);

		     	$em = $this->getDoctrine()->getManager();
		      	$em->persist($Examen);
		      	$em->flush();

		      $request->getSession()->getFlashBag()->add('notice', 'Département bien créée.');

		      return $this->redirectToRoute('ViewExamen', array('ExamenId' => $Examen->getid()));  

		// //////////////////////////////////////////////////////////////////
		

	}

	    return $this->render('NetUniversityPlatformBundle:Examen:add.html.twig', array('form' => $form->createView(),));

	}

public function AddTPAction(Request $request)
	{
				    // On vérifie que l'utilisateur dispose bien du rôle ROLE_AUTEUR
			    if (!$this->get('security.authorization_checker')->isGranted('ROLE_PROF')) {
			      // Sinon on déclenche une exception « Accès interdit »
			      throw new AccessDeniedException('Accès limité aux Profs.');
			    }
		    $TP = New TP();
		    $form   = $this->get('form.factory')->create(TPType::class, $TP);

		    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
		    	$date = new \DateTime();
      			$TP->setdateCreation($date);

			    $repository = $this->getDoctrine()
			      ->getManager()
			      ->getRepository('NetUniversityPlatformBundle:Utilisateur');
			    $user = $repository->find(12);
			    $institut->setUtilisateur($user);

		     	$em = $this->getDoctrine()->getManager();
		      	$em->persist($TP);
		      	$em->flush();

		      $request->getSession()->getFlashBag()->add('notice', 'Département bien créée.');

		      return $this->redirectToRoute('ViewTP', array('TPId' => $TP->getid()));  

		// //////////////////////////////////////////////////////////////////
		
	    $em = $this->getDoctrine()->getManager();
	    $em->persist($TP);
	    $em->flush();

	    if ($request->isMethod('POST')) {
	      $request->getSession()->getFlashBag()->add('notice', 'Département bien enregistrée.');

	      return $this->redirectToRoute('user', array('id' => $user->getId()));
	    }
	}

	    return $this->render('NetUniversityPlatformBundle:TP:add.html.twig', array('form' => $form->createView(),));

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

public function AddUniversityAction(Request $request)
	{

			    // On vérifie que l'utilisateur dispose bien du rôle ROLE_AUTEUR
			    if (!$this->get('security.authorization_checker')->isGranted('ROLE_DOYEN')) {
			      // Sinon on déclenche une exception « Accès interdit »
			      throw new AccessDeniedException('Accès limité aux Doyen.');
			    }

			    //ajouter le stop pour les utilisateur qui ont déja créé une université 
			    /*if ($this->getUser()->getUniversity()) {
			      // Sinon on déclenche une exception « Accès interdit »
			      throw new AccessDeniedException('Accès limité aux Doyen.');
			    } */

		    $university = New University();
		    $form   = $this->get('form.factory')->create(UniversityType::class, $university);

		    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
		    	$date = new \DateTime();
      			$university->setdateCreation($date);
      			$Valid=false;
      			$university->setValid($Valid);
      			$university->upload();
				    $user = $this->getUser();
				    $university->setOwner($user);
		     	$em = $this->getDoctrine()->getManager();
		      	$em->persist($university);
		      	$em->flush();

		      $request->getSession()->getFlashBag()->add('notice', 'Université bien créée.');
 				$Notif="La demande de création de n'université est bien créer !";
		      //return $this->redirectToRoute('ViewUniversity', array('UniversityId' => $university->getid())); 
				   	return $this->redirectToRoute('Notif', array('Notif' => $Notif));

		   

	}
	    return $this->render('NetUniversityPlatformBundle:University:add.html.twig', array('form' => $form->createView(),));
	   

	}



public function AddModuleAction(Request $request)
	{
					    // On vérifie que l'utilisateur dispose bien du rôle ROLE_AUTEUR
			    if (!$this->get('security.authorization_checker')->isGranted('ROLE_PROF')) {
			      // Sinon on déclenche une exception « Accès interdit »
			      throw new AccessDeniedException('Accès limité aux Doyen.');
			    }

	    $Module = New Module();
	    $form   = $this->get('form.factory')->create(ModuleType::class, $Module);

	    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
		    	$date = new \DateTime();
	  			$Module->setdateCreation($date);
				    
			    $user = $this->getUser();
				$Module->setOwner($user);
		     	$em = $this->getDoctrine()->getManager();
		      	$em->persist($Module);
		      	$em->flush();

		      $request->getSession()->getFlashBag()->add('notice', 'Module bien créée.');
		      $Cours=$Module->getCours();

		      return $this->redirectToRoute('ViewModule', array('ModuleId' => $Module->getid(), 'Cours'=> $Cours)); 
			
		    $em = $this->getDoctrine()->getManager();
		    $em->persist($user);
		    $em->flush();

		    if ($request->isMethod('POST')) {
		      $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');

		      return $this->redirectToRoute('user', array('id' => $user->getId()));
		    }
		}
	    return $this->render('NetUniversityPlatformBundle:Module:add.html.twig', array('form' => $form->createView(),));

	}



public function listeUniversityAction(Request $request)
	{
		  $em = $this->getDoctrine()->getManager();
		    // La méthode findAll retourne toutes les catégories de la base de données
    		$listeUniversity = $em->getRepository('NetUniversityPlatformBundle:University')->findAll();

return $this->render('NetUniversityPlatformBundle:University:liste.html.twig', array('listeUniversity' => $listeUniversity));  

	}

public function listeInstitutAction(Request $request)
	{
		$em = $this->getDoctrine()->getManager();
		    // La méthode findAll retourne toutes les catégories de la base de données
	    $listeInstitut = $em->getRepository('NetUniversityPlatformBundle:Institut')->findAll();

		return $this->render('NetUniversityPlatformBundle:Institut:liste.html.twig', array('listeInstitut' => $listeInstitut));  

	}

public function listeDepartementAction(Request $request)
	{
		$em = $this->getDoctrine()->getManager();
		    // La méthode findAll retourne toutes les catégories de la base de données
	    $listeDepartement = $em->getRepository('NetUniversityPlatformBundle:Departement')->findAll();

		return $this->render('NetUniversityPlatformBundle:Departement:liste.html.twig', array('listeDepartement' => $listeDepartement));  

	}

public function listeFiliereAction(Request $request)
	{
		$em = $this->getDoctrine()->getManager();
		    // La méthode findAll retourne toutes les catégories de la base de données
	    $listeFiliere = $em->getRepository('NetUniversityPlatformBundle:Filiere')->findAll();

		return $this->render('NetUniversityPlatformBundle:Filiere:liste.html.twig', array('listeFiliere' => $listeFiliere));  

	}

public function listeModuleAction(Request $request)
	{
		$em = $this->getDoctrine()->getManager();
		    // La méthode findAll retourne toutes les catégories de la base de données
	    $listeModule = $em->getRepository('NetUniversityPlatformBundle:Module')->findAll();

		return $this->render('NetUniversityPlatformBundle:Module:liste.html.twig', array('listeModule' => $listeModule));  

	}
	public function listeCoursAction(Request $request)
	{
		$em = $this->getDoctrine()->getManager();
		    // La méthode findAll retourne toutes les catégories de la base de données
	    $listeCours = $em->getRepository('NetUniversityPlatformBundle:Cours')->findAll();

		return $this->render('NetUniversityPlatformBundle:Cours:liste.html.twig', array('listeCours' => $listeCours));  

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


/*
	public function listeContactsAction(Request $request)
	{
			$InvitationContacts = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('NetUniversityPlatformBundle:Contacts')
            ->findByUser($this->getUser())
          ;
		    // La méthode findAll retourne toutes les catégories de la base de données
	   // $Contacts = $this->getUser()->getContacts();

		return $this->render('NetUniversityPlatformBundle:Contacts:liste.html.twig', array('Contacts' => $Contacts ));  

	} */

	public function afficheUniversityAction($UniversityId)
	{

		if (!isset($UniversityId)) {
      		throw new NotFoundHttpException("L'université n'existe pas.");
    		}
    	else{
			$em = $this->getDoctrine()->getManager();


			// On récupère l'annonce $id
			$university = $em->getRepository('NetUniversityPlatformBundle:University')->find($UniversityId);
		 	$Instituts =$university->getinstitut();

			if (null === $university) {
			  throw new NotFoundHttpException("L'university d'id ".$UniversityId." n'existe pas.");
			}

    		return $this->render('NetUniversityPlatformBundle:University:view.html.twig', array('University'=> $university, 'Instituts'=> $Instituts));
		}
	}

public function afficheInstitutAction($InstitutId)
	{

		if (!isset($InstitutId)) {
      		throw new NotFoundHttpException("L'institut n'existe pas.");
    		}
    	else{
		$em = $this->getDoctrine()->getManager();

		// On récupère l'annonce $id
		$institut = $em->getRepository('NetUniversityPlatformBundle:Institut')->find($InstitutId);

		 	$Departements =$institut->getdepartement();

			if (null === $institut) {
			  throw new NotFoundHttpException("Le Departement d'id ".$institutId." n'existe pas.");
			}

    		return $this->render('NetUniversityPlatformBundle:Institut:view.html.twig', array('Institut'=> $institut, 'Departements'=> $Departements));
		}
	}

	public function afficheDepartementAction($DepartementId)
	{

		if (!isset($DepartementId)) {
      		throw new NotFoundHttpException("Le Dérppartement n'existe pas.");
    		}
    	else{
			$em = $this->getDoctrine()->getManager();


			// On récupère l'annonce $id
			$Departement = $em->getRepository('NetUniversityPlatformBundle:Departement')->find($DepartementId);
		 	$Filieres =$Departement->getfiliere();

			if (null === $Departement) {
			  throw new NotFoundHttpException("Le Departement d'id ".$DepartementId." n'existe pas.");
			}

    		return $this->render('NetUniversityPlatformBundle:Departement:view.html.twig', array('Departement'=> $Departement, 'Filieres'=> $Filieres));
		}
	}

	public function afficheFiliereAction($FiliereId)
	{

		if (!isset($FiliereId)) {
      		throw new NotFoundHttpException("Le Filière n'existe pas.");
    		}
    	else{
			$em = $this->getDoctrine()->getManager();


			// On récupère l'annonce $id
			$Filiere = $em->getRepository('NetUniversityPlatformBundle:Filiere')->find($FiliereId);
		 	$SousFilieres =$Filiere->getsousfiliere();
		 	$Classes =$Filiere->getClasse();

			if (null === $Filiere) {
			  throw new NotFoundHttpException("La Filière d'id ".$FiliereId." n'existe pas.");
			}

    		return $this->render('NetUniversityPlatformBundle:Filiere:view.html.twig', array('Filiere'=> $Filiere, 'SousFilieres'=> $SousFilieres, 'Classes'=> $Classes));
		}
	}

	public function afficheModuleAction($ModuleId)
	{

		if (!isset($ModuleId)) {
      		throw new NotFoundHttpException("Le Filière n'existe pas.");
    		}
    	else{
			$em = $this->getDoctrine()->getManager();


			// On récupère l'annonce $id
			$Module = $em->getRepository('NetUniversityPlatformBundle:Module')->find($ModuleId);
		 	

			if (null === $Module) {
			  throw new NotFoundHttpException("La Filière d'id ".$ModuleId." n'existe pas.");
			}
			$Cours=$Module->getCours();
    		return $this->render('NetUniversityPlatformBundle:Module:view.html.twig', array('Module'=> $Module, 'Cours'=> $Cours)); //array('Module'=> $Module, 'Support'=> $Support)
		}
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
			if (null === $Cours) {
				$Error = "La Cours d'id ".$CoursId." n'existe pas.";
				return $this->redirectToRoute('Error', array('Error'=> $Error));
			}

			$Prof=$Cours->getUtilisateur();
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

	public function AfficheMesModilesAction(Request $request)
	{
		$UserId = $request->get('UserId');

		if (!isset($UserId)) {
      		throw new NotFoundHttpException("L'annonce d'id ".$UserId." n'existe pas.");
    		}
    	else{
		$em = $this->getDoctrine()->getManager();

	// On récupère l'annonce $id
	$utilisateur = $em->getRepository('NetUniversityPlatformBundle:Utilisateur')->find($UserId);

			if (null === $utilisateur) {
			  throw new NotFoundHttpException("L'annonce d'id ".$UserId." n'existe pas.");
			}

    return $this->render('NetUniversityPlatformBundle:Module:listeModules.html.twig', array('UserId' => $UserId));
		}
	}
	public function MyModulesAction(Request $request)
	{
		$UserId = $request->get('UserId');

		if (!isset($UserId)) {
      		throw new NotFoundHttpException("L'annonce d'id ".$UserId." n'existe pas.");
    		}
    	else{
		$em = $this->getDoctrine()->getManager();

	// On récupère l'annonce $id
	$utilisateur = $em->getRepository('NetUniversityPlatformBundle:Utilisateur')->find($UserId);

			if (null === $utilisateur) {
			  throw new NotFoundHttpException("L'annonce d'id ".$UserId." n'existe pas.");
			}

    return $this->render('NetUniversityPlatformBundle:Module:MyModules.html.twig', array('UserId' => $UserId));
		}
	}

 	public function ProfilinfoAction($UserId)
	{

		if (!isset($UserId)) {
      		throw new NotFoundHttpException("L'annonce d'id n'existe pas.");
    		}
    	else{
			$em = $this->getDoctrine()->getManager();

			// On récupère l'annonce $id
			$utilisateur = $em->getRepository('NetUniversityPlatformBundle:Utilisateur')->find($UserId);

			if (null === $utilisateur) {
			  throw new NotFoundHttpException("L'annonce d'id ".$UserId." n'existe pas.");
			}
			$contact= $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('NetUniversityPlatformBundle:Contacts')
            ->checkContact($this->getUser(), $UserId)
          ;
    	return $this->render('NetUniversityPlatformBundle:Utilisateur:Profile.html.twig', array('Utilisateur'=> $utilisateur, 'contact'=> $contact));
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


	public function AffichePublicationAction($UserId)
		{	$em = $this->getDoctrine()->getManager();

		    // On récupère l'annonce $id
		    $Utilisateur = $em->getRepository('NetUniversityPlatformBundle:Utilisateur')->find($UserId);

		    if (null === $Utilisateur) {
		      throw new NotFoundHttpException("L'annonce d'id n'existe pas.");
		    }

			

		    // On récupère la liste des candidatures de cette annonce
		   $listPublication = $em
		      ->getRepository('NetUniversityPlatformBundle:Publication')
		      ->UtilisateurOne($UserId);
		    return $this->render('NetUniversityPlatformBundle:Utilisateur:AffichePublication.html.twig', array(
		      'Utilisateur'     => $Utilisateur, 'listPublication' => $listPublication
		    ));
		}

	public function indexAction()
	{
		       // return new Response("Je suis Utilisateur !");
		        return $this->render('NetUniversityPlatformBundle:Utilisateur:index.html.twig', array('user' => 'Soufiane BERJAMY'));
	}

	public function editAction($id, Request $request)
	{
	$em = $this->getDoctrine()->getManager();

	// On récupère l'annonce $id
	$utilisateur = $em->getRepository('NetUniversityPlatformBundle:Utilisateur')->find($id);

	if (null === $utilisateur) {
	  throw new NotFoundHttpException("L'annonce d'id ".$id." n'existe pas.");
	}

	// La méthode findAll retourne toutes les catégories de la base de données
	$listCategories = $em->getRepository('NetUniversityPlatformBundle:Category')->findAll();

	// On boucle sur les catégories pour les lier à l'annonce
	foreach ($listCategories as $category) {
	  $utilisateur->addCategory($category);
	}

	// Pour persister le changement dans la relation, il faut persister l'entité propriétaire
	// Ici, Advert est le propriétaire, donc inutile de la persister car on l'a récupérée depuis Doctrine

	// Étape 2 : On déclenche l'enregistrement
	$em->flush();

	// … reste de la méthode
	}

	 public function deleteAction($id)
	{
	$em = $this->getDoctrine()->getManager();

	// On récupère l'annonce $id
	$utilisateur = $em->getRepository('NetUniversityPlatformBundle:Utilisateur')->find($id);

	if (null === $utilisateur) {
	  throw new NotFoundHttpException("L'annonce d'id ".$id." n'existe pas.");
	}

	// On boucle sur les catégories de l'annonce pour les supprimer
	foreach ($utilisateur->getCategories() as $category) {
	  $utilisateur->removeCategory($category);
	}

	// Pour persister le changement dans la relation, il faut persister l'entité propriétaire
	// Ici, Advert est le propriétaire, donc inutile de la persister car on l'a récupérée depuis Doctrine

	// On déclenche la modification
	$em->flush();

	// ...
	}


	public function editPublicationAction($UserId)
	{
	  $em = $this->getDoctrine()->getManager();

	  // On récupère l'annonce
	  $Utilisateur = $em->getRepository('NetUniversityPlatformBundle:Utilisateur')->find($UserId);

	  // On modifie l'URL de l'image par exemple
	  $Utilisateur->getPublication()->setLien('test.png');

	  // On n'a pas besoin de persister l'annonce ni l'image.
	  // Rappelez-vous, ces entités sont automatiquement persistées car
	  // on les a récupérées depuis Doctrine lui-même
	  
	  // On déclenche la modification
	  $em->flush();

	  return new Response('OK');
	}

}


?>