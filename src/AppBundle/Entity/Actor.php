<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Actor
 *
 * @ORM\Table(name="actor")
 * @ORM\Entity
 */
class Actor
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false, unique=false)
     */
    private $nombre;

    /**
     * @var integer
     *
     * @ORM\Column(name="anio_nacimiento", type="integer", nullable=false, unique=false)
     */
    private $anioNacimiento;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Actor
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set anioNacimiento
     *
     * @param integer $anioNacimiento
     *
     * @return Actor
     */
    public function setAnioNacimiento($anioNacimiento)
    {
        $this->anioNacimiento = $anioNacimiento;

        return $this;
    }

    /**
     * Get anioNacimiento
     *
     * @return integer
     */
    public function getAnioNacimiento()
    {
        return $this->anioNacimiento;
    }
}

