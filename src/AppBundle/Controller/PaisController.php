<?php
namespace AppBundle\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use AppBundle\Entity\Pais;
class PaisController extends FOSRestController
{

    /**
     * @Rest\Get("/paises")
     */
    public function paisesAction(Request $request)
    {
        // entity manager
        $em = $this->getDoctrine()->getManager();

        // repo películas
        $repoPaises = $em->getRepository('AppBundle:Pais');
        $output = array();

        $paises = $repoPaises->findAll();

        if ($paises) {
            foreach($paises as $pais) {

                //actores
                $actores = array();
                if ($pais->getActores()) {

                  foreach ($pais->getActores() as $actor) {
                      $actores[] = array(
                          'id'             => $actor->getId(),
                          'nombre'         => $actor->getNombre(),
                          'anioNacimiento' => $actor->getAnioNacimiento()
                      );
                  }
                } else {
                  $actores = array();
                }



                //Peliculas
                $pelicula = array();
                if ($pais->getPeliculas()) {

                  foreach ($pais->getPeliculas() as $pelicula) {
                      $pelicula[] = array(
                          'id'             => $pelicula->getId(),
                          'nombre'         => $pelicula->getNombre(),
                          'resumen' => $pelicula->getResumen(),
                          'urlTrailer' => $pelicula->getUrlTrailer()
                      );
                  }
                } else {
                $pelicula[] = array();
                }

                //paises
                $output[] = array(
                    'id'          => $pais->getId(),
                    'nombre'      => $pais->getNombre(),
                    'pelicula'   => $pelicula,
                    'actor'      => $actores
                );
            }
            return new View($output, Response::HTTP_OK);
        } else {
            return new View('No existen país aun.', Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * @Rest\Get("/paises/{id}")
     */
    public function paisAction(Request $request, $id)
    {
        // entity manager
        $em = $this->getDoctrine()->getManager();

        // repo películas
        $repoPaises = $em->getRepository('AppBundle:Pais');
        $output = array();

        // busca la película
        $pais = $repoPaises->find($id);

        if ($pais) {

            //actores
            //actores
            $actores = array();
            if ($pais->getActores()) {

              foreach ($pais->getActores() as $actor) {
                  $actores[] = array(
                      'id'             => $actor->getId(),
                      'nombre'         => $actor->getNombre(),
                      'anioNacimiento' => $actor->getAnioNacimiento()
                  );
              }
            } else {
            $actores = array();
            }



            //Peliculas
            $pelicula = array();
            if ($pais->getPeliculas()) {
              foreach ($pais->getPeliculas() as $pelicula) {
                  $pelicula[] = array(
                      'id'             => $pelicula->getId(),
                      'nombre'         => $pelicula->getNombre(),
                      'resumen' => $pelicula->getResumen(),
                      'urlTrailer' => $pelicula->getUrlTrailer()
                  );
              }
            } else {
            $pelicula[] = array();
            }

            //paises
            $output[] = array(
                'id'          => $pais->getId(),
                'nombre'      => $pais->getNombre(),
                'pelicula'   => $pelicula,
                'actor'      => $actores
            );

            return new View($output, Response::HTTP_OK);
        } else {
            return new View('País no encontrado', Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * @Rest\Post("/paises")
     */
    public function postPaisAction(Request $request)
    {
        // entity manager
        $em = $this->getDoctrine()->getManager();

        //parametros de la petición
        $nombre = $request->request->get('nombre');

        // entidad
        $pais = new Pais();
        $pais->setNombre($nombre);

        // persistencia
        try {
            $em->persist($pais);
            $em->flush();
            return new View('Creación satisfactoria.', Response::HTTP_CREATED);
        } catch (exception $e) {
            return new View('Se presentó un error.', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @Rest\Put("/paises/{id}")
     */
    public function putPaisAction(Request $request, $id)
    {
        // entity manager y repo
        $em = $this->getDoctrine()->getManager();
        $repoPaises = $em->getRepository('AppBundle:Pais');

        //parametros de la petición
        $nombre = $request->request->get('nombre');

        // entidad
        $pais = $repoPaises->find($id);
        $pais->setNombre($nombre);

        // persistencia
        try {
            $em->persist($pais);
            $em->flush();
            return new View('Actualizacion satisfactoria.', Response::HTTP_CREATED);
        } catch (exception $e) {
            return new View('Se presentó un error.', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @Rest\Delete("/paises/{id}")
     */
    public function deletePaisAction(Request $request, $id)
    {
        // entity manager
        $em = $this->getDoctrine()->getManager();

        //repo  y entidad paises
        $repoPaises = $em->getRepository('AppBundle:Pais');
        $pais = $repoPaises->find($id);

        if ($pais) {
            // eliminacion
            $em->remove($pais);
            $em->flush();
            return new View("Eliminación satisfactoria", Response::HTTP_OK);
        } else {
            return new View('Película no encontrada', Response::HTTP_NOT_FOUND);
        }
    }


}
