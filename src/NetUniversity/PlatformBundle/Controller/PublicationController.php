<?php
// src/OC/PlatformBundle/Controller/PublicationController.php

namespace NetUniversity\PlatformBundle\Controller;

use NetUniversity\PlatformBundle\Entity\Utilisateur;
use NetUniversity\PlatformBundle\Entity\Publication;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class PublicationController extends Controller
{
  // …
  public function indexAction()
  {
            //return new Response("Je suis Publication !");
  return $this->render('NetUniversityPlatformBundle:Publication:view.html.twig', array());
  }
  public function editAction($id, Request $request)
  {
    $em = $this->getDoctrine()->getManager();

    // On récupère l'annonce $id
    $Publication = $em->getRepository('NetUniversityPlatformBundle:Publication')->find($id);

    if (null === $Publication) {
      throw new NotFoundHttpException("L'annonce d'id ".$id." n'existe pas.");
    }

    // La méthode findAll retourne toutes les catégories de la base de données
    $listCategories = $em->getRepository('NetUniversityPlatformBundle:Category')->findAll();

    // On boucle sur les catégories pour les lier à l'annonce
    foreach ($listCategories as $category) {
      $Publication->addCategory($category);
    }

    // Pour persister le changement dans la relation, il faut persister l'entité propriétaire
    // Ici, Advert est le propriétaire, donc inutile de la persister car on l'a récupérée depuis Doctrine

    // Étape 2 : On déclenche l'enregistrement
    $em->flush();

    // … reste de la méthode
  }

  public function addAction(Request $request)
  {
      //Créer une nouvelle publication

    $publication = New Publication();

    $em = $this->getDoctrine()->getManager();

    // On récupère l'annonce
    $Utilisateur = $em->getRepository('NetUniversityPlatformBundle:Utilisateur')->find(1);

    $publication->setName('Pub1');
    $publication->setLien('http://www.netuniversity.ma/profilex.php?id=1&affich=196');
    $publication->setUtilisateur($Utilisateur);

       // On récupère l'EntityManager
      $em = $this->getDoctrine()->getManager();

          // Étape 1 : On « persiste » l'entité
      $em->persist($publication);

      // Étape 2 : On « flush » tout ce qui a été persisté avant
      $em->flush();

      // Reste de la méthode qu'on avait déjà écrit
      if ($request->isMethod('POST')) {
        $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');

        // Puis on redirige vers la page de visualisation de cettte annonce
        return $this->redirectToRoute('user', array('id' => $Utilisateur->getId()));
      }

      // Si on n'est pas en POST, alors on affiche le formulaire
      return $this->render('NetUniversityPlatformBundle:Publication:add.html.twig', array('Nom' => $publication->getName(), 'URL'=> $publication->getLien() ));
}

  public function userPublicationAction(Request $request)
  {
      //Créer une nouvelle publication

    $publication = New Publication();
    $user = "Soufiane";

    $em = $this->getDoctrine()->getManager();

    // On récupère l'annonce
    $Utilisateur = $em->getRepository('NetUniversityPlatformBundle:Utilisateur')->findBynom($UserId);

    $publication->setName('Pub1');
    $publication->setLien('http://www.netuniversity.ma/profilex.php?id=1&affich=196');
    $user->setPublication($publication);

       // On récupère l'EntityManager
      $em = $this->getDoctrine()->getManager();

          // Étape 1 : On « persiste » l'entité
      $em->persist($user);

      // Étape 2 : On « flush » tout ce qui a été persisté avant
      $em->flush();

      // Reste de la méthode qu'on avait déjà écrit
      if ($request->isMethod('POST')) {
        $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');

        // Puis on redirige vers la page de visualisation de cettte annonce
        return $this->redirectToRoute('user', array('id' => $user->getId()));
      }

      // Si on n'est pas en POST, alors on affiche le formulaire
      return $this->render('NetUniversityPlatformBundle:Publication:add.html.twig', array('Nom' => $publication->getName(), ''=> $publication->getLien(), ));
    }

  public function AddAction(Request $request)
  {   


        $Cours = New Cours();
        $Recherche = New Recherche();
        $form   = $this->get('form.factory')->create(CoursType::class, $Cours);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
          $date = new \DateTime();
            $Cours->setDateDeCreation($date);
            $Cours->setderniereModif($date);
            $repository = $this->getDoctrine()
            ->getManager()
            ->getRepository('NetUniversityPlatformBundle:Module');
          $Module = $repository->find(2);
          $Module->addCour($Cours);
          $Cours->addModule($Module);
        
          $user = $this->getUser();
          $Cours->setUtilisateur($user);
          $motCle= $Cours->getNom().' '.$Cours->getUtilisateur();
          $Recherche->setMotCle($motCle);
          //$Cours->setModule($Module);
            $Cours->upload();

          $em = $this->getDoctrine()->getManager();
          $em->persist($Cours);
          $Recherche->setcours($Cours);

          $em->persist($Recherche);
          
            
            $em->persist($Module);
            $em->flush();

          $request->getSession()->getFlashBag()->add('notice', 'Département bien créée.');

          return $this->redirectToRoute('ViewCours', array('CoursId' => $Cours->getid()));  

    // //////////////////////////////////////////////////////////////////
  }

      return $this->render('NetUniversityPlatformBundle:Cours:add.html.twig', array('form' => $form->createView(),));

  }

}