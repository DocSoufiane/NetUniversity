<?php

namespace NetUniversity\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('NetUniversityPlatformBundle:Default:index.html.twig');
    }
}
