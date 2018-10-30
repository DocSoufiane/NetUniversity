<?php

// src/NetUniversity/PlatformBundle/Controller/ProfilexController.php

namespace NetUniversity\PlatformBundle\Controller;

// N'oubliez pas ce use :
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class ProfilexController extends Controller
{
	public function indexAction()
	{



		// On a donc accès au conteneur :
   $mailer = $this->container->get('mailer'); 

    // On peut envoyer des e-mails, etc.
    
	$content = $this->get('templating')->render('NetUniversityPlatformBundle:Advert:Profilex.html.twig', array('nom'=>'BERJAMY'));

	return new Response($content);
	}

/*	public function addCommentAction($id)
	{
			if(isset($_POST['commentaire'])){
		if(htmlspecialchars($_POST['commentaire'])!=''){
			
				// Testons si le fichier a bien été envoyé et s'il n'y a pas d'erreur
				if (isset($_FILES['image']) AND $_FILES['image']['error'] == 0)
				{   echo 'le fichier est trouver!!';
						// Testons si le fichier n'est pas trop gros
						if ($_FILES['image']['size'] <= 5000000)
						{
								// Testons si l'extension est autorisée
								$infosfichier = pathinfo($_FILES['image']['name']);
								$extension_upload = $infosfichier['extension'];
								$extensions_autorisees = array('jpg', 'JPG', 'jpeg', 'JPEG', 'png', 'PNG');
								if (in_array($extension_upload, $extensions_autorisees))
								{
										// On peut valider le fichier et le stocker définitivement
										move_uploaded_file($_FILES['image']['tmp_name'], 'images-commentaires/' . basename($_FILES['image']['name']));
										
							$newcommentaire=$bdd->prepare('INSERT INTO commentaires(idproprietaire, idmur, lecommentaire, image, datecommentaire) VALUES(:idproprietaire, :idmur, :lecommentaire, :image, NOW())');
		$newcommentaire->execute(array('idproprietaire' => htmlspecialchars($_SESSION['id']),
										'idmur' => htmlspecialchars($_GET['affich']),
										'lecommentaire' => htmlspecialchars($_POST['commentaire']),
										'image' => 'images-commentaires/' . basename($_FILES['image']['name'])));
										?><br><br><br><?php
	echo "<p style=\"text-align: center;color:#66FF33;\">"; echo " Votre participation est bien enregistrée =) " ;echo "</p>";
										
										
										
										
								}
								
						}
						
				}


	else{		
		$newcommentaire=$bdd->prepare('INSERT INTO commentaires(idproprietaire, idmur, lecommentaire, datecommentaire) VALUES(:idproprietaire, :idmur, :lecommentaire, NOW())');
		$newcommentaire->execute(array('idproprietaire' => htmlspecialchars($_SESSION['id']),
										'idmur' => htmlspecialchars($_GET['affich']),
										'lecommentaire' => htmlspecialchars($_POST['commentaire'])));
										?><br><br><br><?php
	echo "<p style=\"text-align: center;color:#66FF33;\">"; echo " Votre participation est bien enregistrée =) " ;echo "</p>";}
			 }
	}


		$content = $this->get('templating')->render('NetUniversityPlatformBundle:Advert:index.html.twig', array('nom'=> $id))	; // à modifié

	return new Response($content);
	
	}*/
}


/*
class ApiRestHelper
{
    public static function createApiCall($url, $method, $headers, $data = array())
    {
        if ($method == 'PUT')
        {
            $headers[] = 'X-HTTP-Method-Override: PUT';
        }

        $handle = curl_init();
        curl_setopt($handle, CURLOPT_URL, $url);
        curl_setopt($handle, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);

        switch($method)
        {
            case 'GET':
                break;
            case 'POST':
                curl_setopt($handle, CURLOPT_POST, true);
                curl_setopt($handle, CURLOPT_POSTFIELDS, http_build_query($data));
                break;
            case 'PUT':
                curl_setopt($handle, CURLOPT_CUSTOMREQUEST, 'PUT');
                curl_setopt($handle, CURLOPT_POSTFIELDS, http_build_query($data));
                break;
            case 'DELETE':
                curl_setopt($handle, CURLOPT_CUSTOMREQUEST, 'DELETE');
                break;
        }
        $response = curl_exec($handle);
        return $response;
    }
}


function login($username, $password)
{
    $headers = array(
        'Accept: application/json',
        'ZURMO_AUTH_USERNAME: ' . $username,
        'ZURMO_AUTH_PASSWORD: ' . $password,
        'ZURMO_API_REQUEST_TYPE: REST',
    );
    $response = ApiRestHelper::createApiCall('http://%mywebsite.com%/index.php/zurmo/api/login', 'POST', $headers);
    $response = json_decode($response, true);

    if ($response['status'] == 'SUCCESS')
    {
        return $response['data'];
    }
    else
    {
        return false;
    }
} */