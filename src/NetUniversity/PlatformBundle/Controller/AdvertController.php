<?php

// src/NetUniversity/PlatformBundle/Controller/AdvertController.php

namespace NetUniversity\PlatformBundle\Controller;

// N'oubliez pas ce use :
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
/*
class AdvertController extends Controller
{
	public function indexAction()
	{
	$content = $this->get('templating')->render('NetUniversityPlatformBundle:Advert:index.html.twig', array('nom'=>'BERJAMY'));

	return new Response($content);
	}

	public function viewAction($id)
	{

		$content = $this->get('templating')->render('NetUniversityPlatformBundle:Advert:index.html.twig', array('nom'=> $id))	;

	return new Response($content);
	// $id vaut 5 si l'on a appelé l'URL /platform/advert/5

	// Ici, on récupèrera depuis la base de données
	// l'annonce correspondant à l'id $id.
	// Puis on passera l'annonce à la vue pour
	// qu'elle puisse l'afficher

	//return new Response("Affichage de l'annonce d'id : ".$id);
	}
}
