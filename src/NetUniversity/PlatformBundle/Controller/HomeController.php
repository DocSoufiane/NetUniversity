<?php
// inscriptionController.php
namespace NetUniversity\PlatformBundle\Controller;

use NetUniversity\PlatformBundle\Entity\Utilisateur;
use NetUniversity\PlatformBundle\Entity\Publication;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
//use Symfony\Component\Validator\Constraints\DateTime;


class HomeController extends Controller
{
	public function indexAction(Request $request)
	{

		//if(isset($SESSION['id'])){


			return $this->render('NetUniversityPlatformBundle:Home:index.html.twig', array());

		//}

	    // Si on n'est pas en POST, alors on affiche le formulaire
	   //return $this->render('NetUniversityPlatformBundle::login.html.twig', array());


	}

		public function singupAction(Request $request)
	{

	   return $this->render('NetUniversityPlatformBundle::inscription.html.twig', array());


	}

	
}
