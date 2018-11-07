<?php
// inscriptionController.php
namespace NetUniversity\PlatformBundle\Controller;

use NetUniversity\PlatformBundle\Entity\Institut;
use NetUniversity\PlatformBundle\Entity\Departement;

use NetUniversity\PlatformBundle\Form\DepartementType;

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



class DeppartementController extends Controller
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
    	$Deppartement = $em->getRepository('NetUniversityPlatformBundle:Departement')->findById($DeppartementId);


		$repository = $this
		  ->getDoctrine()
		  ->getManager()
		  ->getRepository('NetUniversityPlatformBundle:Roles');

    	$listroles = $repository->findBy(  array('departement' => $Deppartement ));

    	return $this->render('NetUniversityPlatformBundle:Departement:GestionRoles.html.twig', array('ListeUtilisateur'=> $listeUtilisateur, 'listroles'=> $listroles, 'DeppartementId'=> $DeppartementId));

	}



public function AddDeppartementAction(Request $request)
	{
	    if (!$this->get('security.authorization_checker')->isGranted('ROLE_DIRECTEUR')) {
      	// Sinon on déclenche une exception « Accès interdit »
      	throw new AccessDeniedException('Accès limité aux Doyen.');
    	}
			
		$em = $this->getDoctrine()->getManager();
		 $user=$this->getUser();
		    	
	    $Departement = New Departement();
		    $form   = $this->get('form.factory')->create(DepartementType::class, $Departement);
				  
			    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
				    	$checke= $em->getRepository('NetUniversityPlatformBundle:Roles')->Check($Departement->getInstitut(), $this->getUser());
				    	if($checke){
					    	foreach ($checke as $key) {
						    	# code...
							    if($key->getrole()=="Ecrire"){
							    	echo "Vous pouvez editer l'institut ". $key->getInstitut()->getNom();  
					
			    			    	$date = new \DateTime();
					      			$Departement->setdateCreation($date);
					      			$Departement->upload();

								    $user = $this->getUser();
								    $Departement->setowner($user);

							     	$em = $this->getDoctrine()->getManager();
							      	$em->persist($Departement);
							      	$em->flush();

									$request->getSession()->getFlashBag()->add('notice', 'Département bien créée.');

									return $this->redirectToRoute('ViewDepartement', array('DepartementId' => $Departement->getid()));  
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
		    return $this->render('NetUniversityPlatformBundle:Departement:add.html.twig', array('form' => $form->createView(),));
				
		}

		
	


}