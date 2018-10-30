<?php
// inscriptionController.php
namespace NetUniversity\PlatformBundle\Controller;

use NetUniversity\PlatformBundle\Entity\Utilisateur;
use NetUniversity\PlatformBundle\Entity\Publication;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;


class TemplateController extends Controller
{
	public function menuTopAction(Request $request)
	{
		$content = $this->get('templating')->render('NetUniversityPlatformBundle:Template:menuTop.html.twig', array());

	return new Response($content);
	}
	public function ContentHeaderAction(Request $request)
	{
		$content = $this->get('templating')->render('NetUniversityPlatformBundle:Template:content-header.html.twig', array());

	return new Response($content);
	}
}