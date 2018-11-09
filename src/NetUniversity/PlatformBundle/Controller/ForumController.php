<?php 
// forum controler
namespace NetUniversity\PlatformBundle\Controller;


use NetUniversity\PlatformBundle\Entity\Utilisateur;
use NetUniversity\PlatformBundle\Entity\University;
use NetUniversity\PlatformBundle\Entity\Cours;
use NetUniversity\PlatformBundle\Entity\Publication;
use NetUniversity\PlatformBundle\Entity\Institut;
use NetUniversity\PlatformBundle\Entity\Sujet;
use NetUniversity\PlatformBundle\Entity\Recherche;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use NetUniversity\PlatformBundle\Form\UtilisateurType;
use NetUniversity\PlatformBundle\Form\UniversityType;
use NetUniversity\PlatformBundle\Form\CoursType;
use NetUniversity\PlatformBundle\Form\SujetType;
use NetUniversity\PlatformBundle\Form\InstitutType;

//use NetUniversity\PlatformBundle\Form\LocalisationType;
use NetUniversity\PlatformBundle\Repository\UniversityRepository;
use Symfony\Component\Serializer\SerializerInterface;

use Symfony\Component\HttpFoundation\JsonResponse;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


class ForumController extends Controller
{
    public function indexAction()
    {

    	$em = $this->getDoctrine()->getManager();


			// On récupère l'annonce $id
			$Classes = $em->getRepository('NetUniversityPlatformBundle:Classe')->findAll();
		 	

        //return new Response("Page de Forum !");
   	    return $this->render('NetUniversityPlatformBundle:Forum:ListeThemes.html.twig', array('Classes'=> $Classes));

    }




	public function ViewSubjectAction(Request $request, $Id)
	{
		if (!isset($Id)) {
      		throw new NotFoundHttpException("Le sujet n'existe pas.");
    		}
    	else{
		$em = $this->getDoctrine()->getManager();

		// On récupère l'annonce $id
		$Sujet = $em->getRepository('NetUniversityPlatformBundle:Sujet')->find($Id);

			if (null === $Sujet) {
			  throw new NotFoundHttpException("Le Departement d'id ".$Id." n'existe pas.");
			}
          $like=0;
          foreach ($Sujet->getLike() as $User){
				if($this->getUser()== $User){
						$like=1;
				}         
			}
    		return $this->render('NetUniversityPlatformBundle:Forum:viewSujet.html.twig', array('Sujet'=> $Sujet, 'like'=>$like));
		}
	}
	public function ViewClasseAction(Request $request, $Id)
	{

    	$em = $this->getDoctrine()->getManager();


			// On récupère l'annonce $id
			$Classe = $em->getRepository('NetUniversityPlatformBundle:Classe')->find($Id);
		 	
			$ListeSujets=$Classe->getSujet();
			//return new Response("Page de Forum !");
   	    return $this->render('NetUniversityPlatformBundle:Forum:Liste.html.twig', array('ListeSujets'=> $ListeSujets, 'groupe'=> 'Classe', 'idgroupe'=> $Classe->getId()));

   	}
	public function ViewFiliereAction($value='')
	{
		# code...
	}
	public function ViewDeppartementAction($value='')
	{
		# code...
	}
	public function ViewInstitutAction($value='')
	{
		# code...
	}
	public function ViewUniversityAction($value='')
	{
		# code...
	}

	public function afficheAction($SubjectId){




	}

	public function RemoveSujetAction($SujetId){

		if (!isset($SujetId)) {
      		throw new NotFoundHttpException("Le Sujet n'existe pas.");
    		}
    	else{

			$em = $this->getDoctrine()->getManager();


			// On récupère l'annonce $id
			$Sujet = $em->getRepository('NetUniversityPlatformBundle:Sujet')->find($SujetId);

			if (null === $Sujet) {
			  throw new NotFoundHttpException("La Sujet d'id ".$SujetId." n'existe pas.");
			}

			if ($this->getUser() == $Sujet->getutilisateur()) {
			      	$em->remove($Sujet);
			      	//$em->persist($user);
			      	$em->flush();
 			return $this->redirectToRoute('utilisateurview', array('UserId' => $Sujet->getutilisateur()->getId()));

			}

 			return $this->redirectToRoute('ForumSujet', array('SujetId' => $Sujet->getId()));
		}


	}


public function AddSujetAction(Request $request)
	{		
				    // On vérifie que l'utilisateur à le droit (est ce qu'il est authentifier + le droit au forum )
			    // ++++++++++++++++++++++++++++++++++++++++++++=
		

	    $Sujet = New Sujet();
	    $Recherche = New Recherche();
	    $form   = $this->get('form.factory')->create(SujetType::class, $Sujet);

	    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {


			if( $request->get('groupe') == "Classe" or $request->get('groupe') == "filiere" or $request->get('groupe') == "deppartement" or 
				$request->get('groupe') == "institut" or $request->get('groupe') == "university"){

				if($request->get('groupe') == "Classe"){
					$em = $this->getDoctrine()->getManager();
	    			$Classe = $em->getRepository('NetUniversityPlatformBundle:Classe')->find($request->get('idgroupe'));
	    			if($Classe){
						$Sujet->setClasse($Classe);
						//sdump("je suis dans la classe"); dump($Classe->getnom());dump($Sujet->getClasse());die; 
	    			}
	    			else{echo "erreur URL !";}
				}
				elseif($request->get('groupe') == "filiere"){
					$em = $this->getDoctrine()->getManager();
	    			$filiere = $em->getRepository('NetUniversityPlatformBundle:Filiere')->find($request->get('idgroupe'));
	    			if($filiere){
						$Sujet->setFiliere($filiere);

	    			}
	    			else{echo "erreur URL !";}
				}
				elseif($request->get('groupe') == "deppartement"){
					$em = $this->getDoctrine()->getManager();
	    			$deppartement = $em->getRepository('NetUniversityPlatformBundle:Departement')->find($request->get('idgroupe'));
	    			if($deppartement){
						$Sujet->setDeppartement($deppartement);

	    			}
	    			else{echo "erreur URL !";}					
				}
				elseif($request->get('groupe') == "institut"){
					$em = $this->getDoctrine()->getManager();
	    			$institut = $em->getRepository('NetUniversityPlatformBundle:Institut')->find($request->get('idgroupe'));
	    			if($institut){
						$Sujet->setInstitut($institut);

	    			}
	    			else{echo "erreur URL !";}					
				}
				elseif($request->get('groupe') == "university"){
					$em = $this->getDoctrine()->getManager();
	    			$university = $em->getRepository('NetUniversityPlatformBundle:University')->find($request->get('idgroupe'));
	    			if($university){
						$Sujet->setUniversity($university);
	    			}
	    			else{echo "erreur URL !";}					
				}
				else{
					echo "erreur URL !";
				   return $this->render('NetUniversityPlatformBundle:Forum:AddSujet.html.twig', array('form' => $form->createView(),'groupe'=>$request->get('groupe'), 'idgroupe'=>$request->get('idgroupe')));

				}
				
	    	$date = new \DateTime();
  			$Sujet->setdateDeCreation($date);
  			$Sujet->setDateDeModif($date);
  			
		  
		    $user = $this->getUser();
		    $Sujet->setUtilisateur($user);
		    $Sujet->setetat("En Attente");
		    $motCle= $Sujet->getNom().' '.$Sujet->getUtilisateur();
		    $Recherche->setMotCle($motCle);

	     	$em = $this->getDoctrine()->getManager();
	     	$em->persist($Sujet);
	     		      
		    $Recherche->setSujet($Sujet);

	     	$em->persist($Recherche);
	      	$em->flush();

	      $request->getSession()->getFlashBag()->add('notice', 'Sujet bien créé.');

	      return $this->redirectToRoute('ForumSubject', array('Id' => $Sujet->getid())); 

			}

			else {echo "erreur Groupe ou ID !";}

 

		}

		if( $request->isMethod('GET') and null !==$request->get('groupe') and null !==$request->get('idgroupe')) {

			
		   return $this->render('NetUniversityPlatformBundle:Forum:AddSujet.html.twig', array('form' => $form->createView(),'groupe'=>$request->get('groupe'), 'idgroupe'=>$request->get('idgroupe')));


		}
		else{echo "erreur URL !";}
	}

	public function likeSujetAction(Request $request)
	{
		    $em = $this->getDoctrine()->getManager();

		$id = $request->get('Sujet-id');
		$isChecked = $request->get('checkbox-value');
		//$Cours = $this->CoursRepository->findById($id);
	    $Sujet = $em->getRepository('NetUniversityPlatformBundle:Sujet')->find($id);

		//$likeNEW = $Cours->getlike()+1;
		



		
			if ($isChecked == "true") {
				$Sujet->addlike($this->getUser());
			} 
			elseif ($isChecked == "false") {
				$Sujet->removelike($this->getUser());
			}
		
		$em->flush();


	}

}

?>