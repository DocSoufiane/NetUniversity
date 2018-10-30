<?php
// gestionController.php

namespace NetUniversity\PlatformBundle\Controller;

// N'oubliez pas ce use :
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class GestionController extends Controller
{
    public function indexAction()
    {
        return new Response("Page des Gestion !");
    }
}

?>