<?php

namespace NetUniversity\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use NetUniversity\PlatformBundle\Entity\Support;


/**
 * TP
 *
 * @ORM\Table(name="t_p")
 * @ORM\Entity(repositoryClass="NetUniversity\PlatformBundle\Repository\TPRepository")
 */
class TP extends Support
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    public function upload()
      {
        // Si jamais il n'y a pas de fichier (champ facultatif), on ne fait rien
        if (null === $this->file) {
          return;
        }

        // On récupère le nom original du fichier de l'internaute
        $name = $this->file->getClientOriginalName();

        // On déplace le fichier envoyé dans le répertoire de notre choix
        $this->file->move($this->getUploadRootDir(), $name);

        // On sauvegarde le nom de fichier dans notre attribut $url
        $this->urlFile = '../TP/img/'.$name.$this->id;

      }

    

}
