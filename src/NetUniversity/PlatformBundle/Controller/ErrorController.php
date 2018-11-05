<?php
// inscriptionController.php
namespace NetUniversity\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;


//use NetUniversity\PlatformBundle\Form\LocalisationType;


use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
//use Symfony\Component\Validator\Constraints\DateTime;


class ErrorController extends Controller
{


	public function IntrouvableAction(Request $request, $Error)
	{

	    if (isset($Error)){			

			return $this->render('NetUniversityPlatformBundle:Error:introuvable.html.twig', array('Error' => $Error));

		}
		
	}

	public function NotifAction(Request $request, $Notif)
	{

	    if (isset($Notif)){			

			return $this->render('NetUniversityPlatformBundle:Error:Notif.html.twig', array('Notif' => $Notif));

		}
		
	}

}