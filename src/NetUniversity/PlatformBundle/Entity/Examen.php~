<?php

namespace NetUniversity\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use NetUniversity\PlatformBundle\Entity\Support;

/**
 * Examen
 *
 * @ORM\Table(name="examen")
 * @ORM\Entity(repositoryClass="NetUniversity\PlatformBundle\Repository\ExamenRepository")
 */
class Examen extends Support
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


}
