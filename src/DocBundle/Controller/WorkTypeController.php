<?php

namespace DocBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use DocBundle\Entity\WorkType;
use DocBundle\Form\WorkTypeType;

/**
 * WorkType controller.
 *
 */
class WorkTypeController extends Controller
{

    /**
     * Lists all WorkType entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('DocBundle:WorkType')->findAll();

        return $this->render('DocBundle:WorkType:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new WorkType entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new WorkType();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('worktype_show', array('id' => $entity->getId())));
        }

        return $this->render('DocBundle:WorkType:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a WorkType entity.
     *
     * @param WorkType $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(WorkType $entity)
    {
        $form = $this->createForm(new WorkTypeType(), $entity, array(
            'action' => $this->generateUrl('worktype_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new WorkType entity.
     *
     */
    public function newAction()
    {
        $entity = new WorkType();
        $form   = $this->createCreateForm($entity);

        return $this->render('DocBundle:WorkType:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a WorkType entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DocBundle:WorkType')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find WorkType entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('DocBundle:WorkType:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing WorkType entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DocBundle:WorkType')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find WorkType entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('DocBundle:WorkType:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a WorkType entity.
    *
    * @param WorkType $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(WorkType $entity)
    {
        $form = $this->createForm(new WorkTypeType(), $entity, array(
            'action' => $this->generateUrl('worktype_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing WorkType entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DocBundle:WorkType')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find WorkType entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('worktype_edit', array('id' => $id)));
        }

        return $this->render('DocBundle:WorkType:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a WorkType entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('DocBundle:WorkType')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find WorkType entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('worktype'));
    }

    /**
     * Creates a form to delete a WorkType entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('worktype_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
