<?php

namespace DocBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use DocBundle\Entity\Structure;
use DocBundle\Form\StructureType;

use DocBundle\Entity\File;

/**
 * Structure controller.
 *
 */
class StructureController extends Controller
{
    /**
     * Lists all Structure entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('DocBundle:Structure')->findBy([], ['dateStart' => 'DESC']);

        $_SESSION['structureIdsDetailNavigation'] = $this->get('doc.navigation')->getOnlyIds($entities);

        $isAdmin = $this->get('doc.utils')->isAdmin($this->container->get('request'));

        return $this->render('DocBundle:Structure:index.html.twig', array(
            'entities' => $entities,
            "isAdmin" => $isAdmin
        ));
    }


    /**
     * Creates a new Structure entity.
     *
     */
    public function newAction(Request $request)
    {
        $entity = new Structure();
        $form = $this->createForm(new StructureType(), $entity);
        $form->add('submit', 'submit', array('label' => 'Create'));

        if ($form->handleRequest($request)->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $this->get('doc.file')->saveUploadedFiles($entity, 'structure', $entity->getName());

            return $this->redirect($this->generateUrl('structure_show', array('id' => $entity->getId())));
        }

        return $this->render('DocBundle:Structure:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }


    /**
     * Displays a form to edit an existing Structure entity.
     *
     */
    public function editAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('DocBundle:Structure')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Structure entity.');
        }

        $form = $this->createForm(new StructureType(), $entity);
        $form->add('submit', 'submit', array('label' => 'Update'));

        if ($form->handleRequest($request)->isValid()) {

            $em->persist($entity);
            $em->flush();

            $this->get('doc.file')->saveUploadedFiles($entity, 'structure', $entity->getName());

            dump($entity);

            return $this->redirect($this->generateUrl('structure'));
        }

        return $this->render('DocBundle:Structure:new.html.twig', array(
            'entity'      => $entity,
            'form'    => $form->createView()
        ));
    }


    /**
     * Finds and displays a Structure entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DocBundle:Structure')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Structure entity.');
        }

        dump($entity);

        $ids = isset($_SESSION['structureIdsDetailNavigation'])
              ? $_SESSION['structureIdsDetailNavigation']
              : $this->get('doc.navigation')->getOnlyIds($em->getRepository('DocBundle:Structure')->findAll());

        return $this->render('DocBundle:Structure:show.html.twig', array(
            'entity'      => $entity,
            'ids' => $ids
        ));
    }


    /**
     * Deletes a Structure entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('DocBundle:Structure')->find($id);

        if ($entity) {
          $this->get('doc.file')->removeFiles($entity->getFiles());
          $em->remove($entity);
          $em->flush();
        }

        return $this->redirect($this->generateUrl('structure'));
    }
}
