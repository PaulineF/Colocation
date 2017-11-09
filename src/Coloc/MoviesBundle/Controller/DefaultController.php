<?php

namespace Coloc\MoviesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Unirest\Request;
use Coloc\MoviesBundle\Entity\Choice;
use Coloc\MoviesBundle\Form\ChoicesType;

class DefaultController extends Controller
{

    public function indexAction()
    {
    	$em = $this->getDoctrine()->getManager();

        $choices = $em->getRepository('ColocMoviesBundle:Choice')->findAll();

        return $this->render('ColocMoviesBundle:Default:index.html.twig', array("choices" => $choices));
    }

    public function addAction()
    {
    	$choice = new Choice();
        $form = $this->createForm("Coloc\MoviesBundle\Form\ChoicesType", $choice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($choice);
            $em->flush();

            return $this->redirectToRoute('index');
        }

        return $this->render('ColocMoviesBundle:Default:add.html.twig', array(
            'choice' => $choice,
            'form' => $form->createView(),
        ));
    }

    public function movieAction($choiceId)
    {
    	$em = $this->getDoctrine()->getManager();
        $choice = $em->getRepository('ColocMoviesBundle:Choice')->find($choiceId);

    	$response = Request::get('http://www.omdbapi.com/?apikey=8bb45b28&i='.$choice->getFilmId())->body;
        return $this->render('ColocMoviesBundle:Default:movie.html.twig', array("choice" => $choice, "movie"=> $response ));
    }
}
