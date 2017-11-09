<?php

namespace Coloc\MoviesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
    	$em = $this->getDoctrine()->getManager();

        $choices = $em->getRepository('ColocMoviesBundle:Choice')->findAll();

        return $this->render('ColocMoviesBundle:Default:index.html.twig', array("choices" => $choices));
    }

    public function searchAction()
    {
    	return $this->render('ColocMoviesBundle:Default:search.html.twig');
    }
}
