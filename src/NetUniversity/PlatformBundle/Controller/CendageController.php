<?php
// CendageController.php

namespace NetUniversity\PlatformBundle\Controller;

use Symfony\Component\HttpFoundation\Response;

class CendageController
{
    public function indexAction()
    {
        return new Response("Page de Cendage !");
    }
}
?>