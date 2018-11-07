<?php
// inscriptionController.php
namespace NetUniversity\PlatformBundle\Controller;

use NetUniversity\PlatformBundle\Entity\Institut;
use NetUniversity\PlatformBundle\Entity\Departement;
use NetUniversity\PlatformBundle\Entity\Filiere;

use NetUniversity\PlatformBundle\Form\DepartementType;
use NetUniversity\PlatformBundle\Form\FiliereType;

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



class FiliereController extends Controller
{

	public function GestionIndexAction(Request $request, $DeppartementId){
		if (!$this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
	      // Sinon on déclenche une exception « Accès interdit »
	      throw new AccessDeniedException('Accès limité aux ADMINS.');
	    }

    		return $this->render('NetUniversityPlatformBundle:Departement:Gestionindex.html.twig', array('DeppartementId'=> $DeppartementId));
	}

	public function GestionRoleAction(Request $request, $DeppartementId){
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

    	return $this->render('NetUniversityPlatformBundle:Departement:GestionRoles.html.twig', array('ListeUtilisateur'=> $listeUtilisateur, 'listroles'=> $listroles, 'DeppartementId'=> $DeppartementId));

	}



public function AddFiliereAction(Request $request)
	{
	    if (!$this->get('security.authorization_checker')->isGranted('ROLE_CHEF_FILIERE')) {
      	// Sinon on déclenche une exception « Accès interdit »
      	throw new AccessDeniedException('Accès limité aux Doyen.');
    	}
			
		$em = $this->getDoctrine()->getManager();
		 $user=$this->getUser();
		    	

		    $Filiere = New Filiere();
		    $form   = $this->get('form.factory')->create(FiliereType::class, $Filiere);
				  
			    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
				    	$checke= $em->getRepository('NetUniversityPlatformBundle:Roles')->CheckDeppartement($Filiere->getDepartement(), $this->getUser());
				    	if($checke){
					    	foreach ($checke as $key) {
						    	# code...
							    if($key->getrole()=="Ecrire"){
							    	echo "Vous pouvez editer le deppartement ". $key->getDepartement()->getNom();  
					
							    	$date = new \DateTime();
					      			$Filiere->setdateCreation($date);
					      			$Filiere->upload();

								    $user = $this->getUser();
								    $Filiere->setOwner($user);
								    
								    $repository = $this->getDoctrine()
								      ->getManager()
								      ->getRepository('NetUniversityPlatformBundle:Departement');
								    $Departement = $repository->find(3);
								    $Filiere->setDepartement($Departement);

								    $repository = $this->getDoctrine()
								      ->getManager()
								      ->getRepository('NetUniversityPlatformBundle:Filiere');
								    $Filiere2 = $repository->find(8);
								    $Filiere->setSousfiliere($Filiere2);

							     	$em = $this->getDoctrine()->getManager();
							      	$em->persist($Filiere);
							      	$em->flush();

							      $request->getSession()->getFlashBag()->add('notice', 'Filière bien créée.');

							      return $this->redirectToRoute('ViewFiliere', array('FiliereId' => $Filiere->getid()));  

								}
							
								else{ 
									echo "vous n'avez pas le droit d'éditer!";	
								}
							}
						}
						else{
							echo "Vous n'avez aucun droit !";
						}
				}
	    return $this->render('NetUniversityPlatformBundle:Filiere:add.html.twig', array('form' => $form->createView(),));
				
	}
/*
public function AddFiliereAction(Request $request)
	{
						    // On vérifie que l'utilisateur dispose bien du rôle ROLE_AUTEUR
			    if (!$this->get('security.authorization_checker')->isGranted('ROLE_CHEF_FILIERE')) {
			      // Sinon on déclenche une exception « Accès interdit »
			      throw new AccessDeniedException('Accès limité aux Doyen.');
			    }

		    $Filiere = New Filiere();
		    $form   = $this->get('form.factory')->create(FiliereType::class, $Filiere);

		    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
		    	$date = new \DateTime();
      			$Filiere->setdateCreation($date);
      			$Filiere->upload();

			    $user = $this->getUser();
			    $Filiere->setOwner($user);
			    
			    $repository = $this->getDoctrine()
			      ->getManager()
			      ->getRepository('NetUniversityPlatformBundle:Departement');
			    $Departement = $repository->find(3);
			    $Filiere->setDepartement($Departement);

			    $repository = $this->getDoctrine()
			      ->getManager()
			      ->getRepository('NetUniversityPlatformBundle:Filiere');
			    $Filiere = $repository->find(8);
			    $Filiere->setSousfiliere($Filiere);

		     	$em = $this->getDoctrine()->getManager();
		      	$em->persist($Filiere);
		      	$em->flush();

		      $request->getSession()->getFlashBag()->add('notice', 'Filière bien créée.');

		      return $this->redirectToRoute('ViewFiliere', array('FiliereId' => $Filiere->getid()));  


	}

	    return $this->render('NetUniversityPlatformBundle:Filiere:add.html.twig', array('form' => $form->createView(),));

	}
	*/
		
	


}