<?php
// GestionClasseController.php
namespace NetUniversity\PlatformBundle\Controller;

use Symfony\Component\HttpFoundation\Response;

class GestionClasseController
{
    public function indexAction()
    {
        return new Response("Page des Gestion de classe !");
    }
}


?>