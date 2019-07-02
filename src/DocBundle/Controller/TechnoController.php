<?php

namespace DocBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use DocBundle\Entity\Techno;
use DocBundle\Form\TechnoType;
use DocBundle\Entity\File;
use Doctrine\ORM\EntityManager;

/**
 * Techno controller.
 *
 */
class TechnoController extends Controller
{
    /**
     * Lists all Techno entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('DocBundle:Techno')->findBy([], array("startedYear" => "DESC"));

        $_SESSION['technoIdsDetailNavigation'] = $this->get('doc.navigation')->getOnlyIds($entities);

        $isAdmin = $this->get('doc.utils')->isAdmin($this->container->get('request'));

        return $this->render('DocBundle:Techno:index.html.twig', array(
            'entities' => $entities,
            "isAdmin" => $isAdmin
        ));
    }


        /**
     * Creates a new Techno entity.
     *
     */
    public function newAction(Request $request)
    {
        $entity = new Techno();

        $form = $this->createForm(new TechnoType(), $entity);

        $form->add('submit', 'submit', array('label' => 'Create'));

        $form->handleRequest($request);

        if ($form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $this->get('doc.file')->saveUploadedFiles($entity, 'techno', $entity->getName());

            return $this->redirect($this->generateUrl('techno_show', array('id' => $entity->getId())));
        }

        return $this->render('DocBundle:Techno:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }


    /**
     * Displays a form to edit an existing Techno entity.
     *
     */
    public function editAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('DocBundle:Techno')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find techno entity.');
        }

        $form = $this->createForm(new TechnoType(), $entity);
        $form->add('submit', 'submit', array('label' => 'Update'));

        if ($form->handleRequest($request)->isValid()) {

            $em->persist($entity);
            $em->flush();

            $tata = $this->get('doc.file')->saveUploadedFiles($entity, 'techno', $entity->getName());

            return $this->redirect($this->generateUrl('techno_admin'));
        }

        return $this->render('DocBundle:Techno:new.html.twig', array(
            'entity'  => $entity,
            'form'    => $form->createView()
        ));
    }


    /**
     * Finds and displays a Techno entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DocBundle:Techno')->find($id);

        dump($entity);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Techno entity.');
        }

        $ids = isset($_SESSION['technoIdsDetailNavigation'])
              ? $_SESSION['technoIdsDetailNavigation']
              : $this->get('doc.navigation')->getOnlyIds($em->getRepository('DocBundle:Techno')->findAll());

        return $this->render('DocBundle:Techno:show.html.twig', array(
            'entity'      => $entity,
            'ids' => $ids
        ));
    }


    /**
     * Deletes a Techno entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('DocBundle:Techno')->find($id);

        if ($entity) {
          $this->get('doc.file')->removeFiles($entity->getFiles());
          $em->remove($entity);
          $em->flush();
        }

        return $this->redirectToRoute('techno');
    }
}
