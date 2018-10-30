<?php 
// forum controler
namespace NetUniversity\PlatformBundle\Controller;

use Symfony\Component\HttpFoundation\Response;

class ForumController
{
    public function indexAction()
    {
        return new Response("Page de Forum !");
    }
}

?>