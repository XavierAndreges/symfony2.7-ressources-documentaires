<?php

namespace DocBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use DocBundle\Entity\Job;
use DocBundle\Form\JobType;
use DocBundle\Entity\File;
use Doctrine\ORM\EntityManager;

/**
 * Job controller.
 *
 */
class JobController extends Controller
{
    /**
     * Lists all Job entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('DocBundle:Job')->findBy([], array('dateStart' => 'desc'));

        dump($entities);

        $_SESSION['jobIdsDetailNavigation'] = $this->get('doc.navigation')->getOnlyIds($entities);

        $isAdmin = $this->get('doc.utils')->isAdmin($this->container->get('request'));

        return $this->render('DocBundle:Job:index.html.twig', array(
            'entities' => $entities,
            "isAdmin" => $isAdmin
        ));
    }


    /**
     * Creates a new Job entity.
     *
     */
    public function newAction(Request $request)
    {
        $entity = new Job();

        $form = $this->createForm(new JobType(), $entity);

        $form->add('submit', 'submit', array('label' => 'Create'));

        $form->handleRequest($request);

        if ($form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $this->get('doc.file')->saveUploadedFiles($entity, 'job', $entity->getfunctionFr());

            return $this->redirect($this->generateUrl('job_show', array('id' => $entity->getId())));
        }

        return $this->render('DocBundle:Job:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }


    /**
     * Displays a form to edit an existing Job entity.
     *
     */
    public function editAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('DocBundle:Job')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Job entity.');
        }

        $form = $this->createForm(new JobType(), $entity);
        $form->add('submit', 'submit', array('label' => 'Update'));

        if ($form->handleRequest($request)->isValid()) {

            $em->persist($entity);
            $em->flush();

            //$nameStructure = $entity->getStructure() !== null ? $entity->getStructure()->getName() : "";

            $this->get('doc.file')->saveUploadedFiles($entity, 'job', $entity->getfunctionFr());

            dump($entity);

            return $this->redirect($this->generateUrl('job_show', array('id' => $entity->getId())));
        }

        return $this->render('DocBundle:Job:new.html.twig', array(
            'entity'  => $entity,
            'form'    => $form->createView()
        ));
    }


    /**
     * Finds and displays a Job entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DocBundle:Job')->find($id);

        dump($entity);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Job entity.');
        }

        $ids = isset($_SESSION['jobIdsDetailNavigation'])
              ? $_SESSION['jobIdsDetailNavigation']
              : $this->get('doc.navigation')->getOnlyIds($em->getRepository('DocBundle:Job')->findAll());

        $works = $em->getRepository('DocBundle:Work')->findBy(["job" => $entity], array('dateStart' => 'desc'));

        return $this->render('DocBundle:Job:show.html.twig', array(
            'entity' => $entity,
            'ids' => $ids,
            'works' => $works
        ));
    }


    /**
     * Deletes a Job entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('DocBundle:Job')->find($id);

        if ($entity) {
          $this->get('doc.file')->removeFiles($entity->getFiles());
          $em->remove($entity);
          $em->flush();
        }

        return $this->redirectToRoute('job');
    }
}
