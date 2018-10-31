<?php
// inscriptionController.php
namespace NetUniversity\PlatformBundle\Controller;

use NetUniversity\PlatformBundle\Entity\Utilisateur;
use NetUniversity\PlatformBundle\Entity\University;
use NetUniversity\PlatformBundle\Entity\Cours;
use NetUniversity\PlatformBundle\Entity\Publication;
use NetUniversity\PlatformBundle\Entity\Institut;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use NetUniversity\PlatformBundle\Form\UtilisateurType;
use NetUniversity\PlatformBundle\Form\UniversityType;
use NetUniversity\PlatformBundle\Form\CoursType;
use NetUniversity\PlatformBundle\Form\InstitutType;

//use NetUniversity\PlatformBundle\Form\LocalisationType;
use NetUniversity\PlatformBundle\Repository\UniversityRepository;
use Symfony\Component\Serializer\SerializerInterface;

use Symfony\Component\HttpFoundation\JsonResponse;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
//use Symfony\Component\Validator\Constraints\DateTime;
//use JMS\Serializer\SerializerBuilder;



class UniversityController extends Controller
{

	public function getInstitutByIdAction(Request $request){
		if($this->getUser()){
			$em = $this->get('doctrine')->getManager();
       
			$id = $request->get('universityID');
			$University= New University;
			//$University = $this->UniversityRepository->findById($id);
			
			$repository = $this->getDoctrine()
			      ->getManager()
			      ->getRepository('NetUniversityPlatformBundle:University');
			    $University = $repository->find($id);
				$liste_Instituts= array(""); 
				$Instituts=$this->getDoctrine()->getManager()->getRepository('NetUniversityPlatformBundle:Institut')->getInstitutByUniversity($University->getId());
			       
		       	
	         foreach($Instituts as $Institut)
	         {
	         	$Institut=array('InstitutNom'=> $Institut->getNom(), 'InstitutID'=> $Institut->getId());
	            array_push($liste_Instituts, $Institut);
	         }

  return new JsonResponse($liste_Instituts);

	        										//= $University->getInstitut();
//$Instituts=$this
  //          ->getDoctrine()
    //        ->getManager()
      //      ->getRepository('NetUniversityPlatformBundle:Institut')
        //    ->getInstitutByUniversity($University->getId())
          //;

	     //  dump($University);
	       //dump($Instituts); //die;
	       //die;
			//$serializer = $this->container->get('serializer');
			
			//$reports = $serializer->serialize($University, 'json');
			//return new Response($reports);
		
		//$serializer = $this->get('serializer');
        //$response = $serializer->serialize($University,'json');

       // return new Response($response);


		//	$response = new Response(json_encode(array('Instituts' => $Instituts)));
		//	$response->headers->set('Content-Type', 'application/json');

		//	return $response;


		}
	}
}