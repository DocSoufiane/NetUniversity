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
use NetUniversity\PlatformBundle\Form\UniversityType;
use NetUniversity\PlatformBundle\Form\DepartementType;
use NetUniversity\PlatformBundle\Form\InstitutType;
use NetUniversity\PlatformBundle\Form\FiliereType;
use NetUniversity\PlatformBundle\Form\ModuleType;
use NetUniversity\PlatformBundle\Form\RechercheType;
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


class RechercheController extends Controller
{


	public function rechercheAction(Request $request)
	{


	    $Recherche = New Recherche();
	    $form   = $this->get('form.factory')->create(RechercheType::class, $Recherche);
	    //dump($request->isMethod('POST'));
	    //dump($form->handleRequest($request)->isValid());die;
	    
	    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
		//$stack = array();

			$resultat = explode ( " " , htmlspecialchars(mb_strtolower($request->get('recherche'))));

			$em = $this->getDoctrine()->getManager();

	    	$result = $em->getRepository('NetUniversityPlatformBundle:Recherche')->findAll();

			//$result = $participation->query('SELECT * FROM mur WHERE activation= 1 ORDER BY id DESC');
				
			foreach ($result as $don) {
				
				$mots = explode ( " ", htmlspecialchars($don->getMotCle()));
				$r=0;$v=0;

				while($r<count($mots))
				{
					if ( in_array(mb_strtolower($mots[$r]), $resultat)){
						$v++;
					}
					$r++;
				}

				if ((($v*100)/count($resultat))>80){
					array_push($stack, $don);
				}
			}

			return $this->render('NetUniversityPlatformBundle:Recherche:resultat.html.twig', array('resultat' => $stack));

		}
//return $this->render('NetUniversityPlatformBundle:Module:add.html.twig', array('form' => $form->createView(),));


		return $this->render('NetUniversityPlatformBundle:Recherche:form.html.twig', array('form' => $form->createView(),));
	}

}