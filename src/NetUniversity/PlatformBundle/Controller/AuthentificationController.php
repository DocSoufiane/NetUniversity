<?php 
// Authentification file


namespace NetUniversity\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class AuthentificationController extends Controller
{
    public function indexAction()
    {
    	
        return new Response("Page d'Authentification !");
    }
}

?>