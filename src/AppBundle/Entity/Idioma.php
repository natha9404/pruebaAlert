<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Idioma
 *
 * @ORM\Table(name="idioma")
 * @ORM\Entity
 */
class Idioma
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
     * @ORM\Column(name="nombre", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $nombre;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Pelicula", inversedBy="audios")
     * @ORM\JoinTable(name="idioma_pelicula",
     *   joinColumns={
     *     @ORM\JoinColumn(name="idioma_id", referencedColumnName="id", onDelete="CASCADE")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="pelicula_id", referencedColumnName="id", onDelete="CASCADE")
     *   }
     * )
     */
    private $audioPeliculas;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Pelicula", mappedBy="subtitulos")
     */
    private $subtitulosPeliculas;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->audioPeliculas = new \Doctrine\Common\Collections\ArrayCollection();
        $this->subtitulosPeliculas = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * @return Idioma
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
     * Add audioPelicula
     *
     * @param \AppBundle\Entity\Pelicula $audioPelicula
     *
     * @return Idioma
     */
    public function addAudioPelicula(\AppBundle\Entity\Pelicula $audioPelicula)
    {
        $this->audioPeliculas[] = $audioPelicula;

        return $this;
    }

    /**
     * Remove audioPelicula
     *
     * @param \AppBundle\Entity\Pelicula $audioPelicula
     */
    public function removeAudioPelicula(\AppBundle\Entity\Pelicula $audioPelicula)
    {
        $this->audioPeliculas->removeElement($audioPelicula);
    }

    /**
     * Get audioPeliculas
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAudioPeliculas()
    {
        return $this->audioPeliculas;
    }

    /**
     * Add subtitulosPelicula
     *
     * @param \AppBundle\Entity\Pelicula $subtitulosPelicula
     *
     * @return Idioma
     */
    public function addSubtitulosPelicula(\AppBundle\Entity\Pelicula $subtitulosPelicula)
    {
        $this->subtitulosPeliculas[] = $subtitulosPelicula;

        return $this;
    }

    /**
     * Remove subtitulosPelicula
     *
     * @param \AppBundle\Entity\Pelicula $subtitulosPelicula
     */
    public function removeSubtitulosPelicula(\AppBundle\Entity\Pelicula $subtitulosPelicula)
    {
        $this->subtitulosPeliculas->removeElement($subtitulosPelicula);
    }

    /**
     * Get subtitulosPeliculas
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSubtitulosPeliculas()
    {
        return $this->subtitulosPeliculas;
    }
}

