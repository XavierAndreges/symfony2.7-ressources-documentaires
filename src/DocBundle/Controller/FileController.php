<?php

namespace DocBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use DocBundle\Entity\File;
use DocBundle\Form\FileType;

/**
 * File controller.
 *
 */
class FileController extends Controller
{

    /**
     * Lists all File entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('DocBundle:File')->findAll();

        return $this->render('DocBundle:File:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new File entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new File();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('file_show', array('id' => $entity->getId())));
        }

        return $this->render('DocBundle:File:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a File entity.
     *
     * @param File $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(File $entity)
    {
        $form = $this->createForm(new FileType(), $entity, array(
            'action' => $this->generateUrl('file_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new File entity.
     *
     */
    public function newAction()
    {
        $entity = new File();
        $form   = $this->createCreateForm($entity);

        return $this->render('DocBundle:File:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a File entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DocBundle:File')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find File entity.');
        }

        dump($entity->getWorks()->toArray());
        dump($entity->getStructures()->toArray());
        dump($entity->getJobs()->toArray());

        return $this->render('DocBundle:File:show.html.twig', array(
            'entity'      => $entity
        ));
    }

    /**
     * Displays a form to edit an existing File entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DocBundle:File')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find File entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('DocBundle:File:new.html.twig', array(
            'entity'        => $entity,
            'form'          => $editForm->createView(),
            'delete_form'   => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a File entity.
    *
    * @param File $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(File $entity)
    {
        $form = $this->createForm(new FileType(), $entity, array(
            'action' => $this->generateUrl('file_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));


        return $form;
    }
    /**
     * Edits an existing File entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DocBundle:File')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find File entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('file_edit', array('id' => $id)));
        }

        return $this->render('DocBundle:File:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }


    /**
     * Deletes a File entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('DocBundle:File')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find File entity.');
        }

        $this->get('doc.file')->removeUpload($entity->getFileName());
        $em->remove($entity);
        $em->flush();

        return $this->redirect($this->generateUrl('file'));
    }
}
