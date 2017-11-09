<?php

namespace Coloc\MoviesBundle\Controller;

use Coloc\MoviesBundle\Entity\Choice;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;
use Unirest\Request as Unirest;

/**
 * Choice controller.
 *
 * @Route("movies")
 */
class ChoiceController extends Controller
{
    /**
     * Lists all choice entities.
     *
     * @Route("/", name="movies_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $choices = $em->getRepository('ColocMoviesBundle:Choice')->findAll();

        return $this->render('ColocMoviesBundle:choice:index.html.twig', array(
            'choices' => $choices,
        ));
    }

    /**
     * Creates a new choice entity.
     *
     * @Route("/new", name="movies_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $choice = new Choice();
        $form = $this->createForm('Coloc\MoviesBundle\Form\ChoicesType', $choice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($choice);
            $em->flush();

            return $this->redirectToRoute('movies_show', array('id' => $choice->getId()));
        }

        return $this->render('ColocMoviesBundle:choice:new.html.twig', array(
            'choice' => $choice,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a choice entity.
     *
     * @Route("/{id}", name="movies_show")
     * @Method("GET")
     */
    public function showAction(Choice $choice)
    {
        $deleteForm = $this->createDeleteForm($choice);

        return $this->render('ColocMoviesBundle:choice:show.html.twig', array(
            'choice' => $choice,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing choice entity.
     *
     * @Route("/{id}/edit", name="movies_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Choice $choice)
    {
        $deleteForm = $this->createDeleteForm($choice);
        $editForm = $this->createForm('Coloc\MoviesBundle\Form\ChoicesType', $choice);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('movies_edit', array('id' => $choice->getId()));
        }

        return $this->render('ColocMoviesBundle:choice:edit.html.twig', array(
            'choice' => $choice,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a choice entity.
     *
     * @Route("/{id}", name="movies_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Choice $choice)
    {
        $form = $this->createDeleteForm($choice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($choice);
            $em->flush();
        }

        return $this->redirectToRoute('movies_index');
    }

    /**
     * Creates a form to delete a choice entity.
     *
     * @param Choice $choice The choice entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Choice $choice)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('movies_delete', array('id' => $choice->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
