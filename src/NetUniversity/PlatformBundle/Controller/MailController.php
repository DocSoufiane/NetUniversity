<?php
// mailController. mailController.php

namespace NetUniversity\PlatformBundle\Controller;

use NetUniversity\PlatformBundle\Entity\Utilisateur;
use NetUniversity\PlatformBundle\Entity\Publication;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
//use Symfony\Component\Validator\Constraints\DateTime;


class MailController extends Controller
{

	public function indexAction(Request $request)
	{

			return $this->render('NetUniversityPlatformBundle:Mail:index.html.twig', array());

	}

	public function composeAction(Request $request)
	{

			return $this->render('NetUniversityPlatformBundle:Mail:compose.html.twig', array());

	}

	public function readAction(Request $request)
	{

			return $this->render('NetUniversityPlatformBundle:Mail:read.html.twig', array());

	}


	
}
