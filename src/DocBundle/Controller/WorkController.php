<?php

namespace DocBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use DocBundle\Entity\Work;
use DocBundle\Form\WorkType;

/**
 * Work controller.
 *
 */
class WorkController extends Controller
{

    /**
     * Lists all Work entities.
     *
     */
    public function indexAction(Request $request, $workType)
    {
        dump($request->request->all());

        $em = $this->getDoctrine()->getManager();


        //************** LISTES DE TRI ****************

        $workTypesList = $em->getRepository('DocBundle:WorkType')->findAll();

        $technosList = $em->getRepository('DocBundle:Techno')->findAll();


        //************** GESTION DES CRITERES DE TRI ****************

        $classement = [];
        $criteriaArray = [];

        //## classement

        $dateOrder = $request->request->get('classement') !== "id" ? $request->request->get('classement') : null;

/*to delete
        if ($dateOrder != null) {
          $classement['dateStart'] = $dateOrder;
        }
*/
        //## workType

        $workTypeSelected = $em ->getRepository('DocBundle:WorkType')
                                ->findOneBy(array('idName' => $request->request->get('workType')));

        $workTypeSelectedIdName = null;

        if ($workTypeSelected !== null) {
          $workTypeSelectedIdName = $workTypeSelected->getIdName();
        }

        $criteriaArray["workType"] = $workTypeSelected;

        //## technos

        $technoSelected = $em ->getRepository('DocBundle:Techno')
                                ->findOneBy(array('name' => $request->request->get('techno')));

        dump("techno", $technoSelected);

        $technoSelectedName = null;

        if ($technoSelected !== null) {
          $technoSelectedName = $technoSelected->getName();
        }

        $criteriaArray["techno"] = $technoSelected;


        //*************** APPLICATION DES CRITERES *******************

        dump("criteria", $criteriaArray);

        $entities = $em->getRepository('DocBundle:Work')->getWorksWithCriteria($criteriaArray, $dateOrder);

        $_SESSION['workIdsDetailNavigation'] = $this->get('doc.navigation')->getOnlyIds($entities);

        $isAdmin = $this->get('doc.utils')->isAdmin($this->container->get('request'));


        //**********************************************************

        return $this->render('DocBundle:Work:index.html.twig', array(
            'entities' => $entities,
            'dateOrder' => $dateOrder,
            'workTypesList' => $workTypesList,
            'technosList' => $technosList,
            'workTypeSelectedIdName' => $workTypeSelectedIdName,
            'technoSelectedName' => $technoSelectedName,
            "isAdmin" => $isAdmin
        ));
    }


    /**
     * Creates a new Work entity.
     *
     */
    public function newAction(Request $request)
    {
        $entity = new Work();
        $form = $this->createForm(new WorkType(), $entity);
        $form->add('submit', 'submit', array('label' => 'Create'));

        if ($form->handleRequest($request)->isValid()) {

            dump($entity);

            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $this->get('doc.file')->saveUploadedFiles($entity, 'work', $entity->getNameFr());

            dump($entity);

            return $this->redirect($this->generateUrl('work_show', array('id' => $entity->getId())));
        }

        return $this->render('DocBundle:Work:new.html.twig', array(
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
        $entity = $em->getRepository('DocBundle:Work')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Work entity.');
        }

        $form = $this->createForm(new WorkType(), $entity);
        $form->add('submit', 'submit', array('label' => 'Update'));

        if ($form->handleRequest($request)->isValid()) {

            $em->persist($entity);
            $em->flush();

            dump($entity);

            $this->get('doc.file')->saveUploadedFiles($entity, 'work', $entity->getNameFr());

            return $this->redirect($this->generateUrl('work'));
        }

        return $this->render('DocBundle:Work:new.html.twig', array(
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

        $entity = $em->getRepository('DocBundle:Work')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Work entity.');
        }

        dump($entity);

        $ids = isset($_SESSION['workIdsDetailNavigation'])
              ? $_SESSION['workIdsDetailNavigation']
              : $this->get('doc.navigation')->getOnlyIds($em->getRepository('DocBundle:Work')->findAll());

        return $this->render('DocBundle:Work:show.html.twig', array(
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

        $entity = $em->getRepository('DocBundle:Work')->find($id);

        if ($entity) {
          $this->get('doc.file')->removeFiles($entity->getFiles());
          $em->remove($entity);
          $em->flush();
        }

        return $this->redirect($this->generateUrl('work'));
    }



    public function getAction()
    {

      $em = $this->getDoctrine()->getManager();

      $works = $em->getRepository('DocBundle:Work')->findAll();

      dump($works);

      if (!$works) {
          throw $this->createNotFoundException();
      }

      //return new Response(var_dump($works));

      $worksArray = array();

      for ($i = 0; $i < count($works); $i++) {

        $tagString = "";
        $tempTagArray = $works[$i]->getTags();

        if (count($tempTagArray) > 0) {
          for ($n = 0; $n < count($tempTagArray); $n++) {
            $tagString .= $tempTagArray[$n]->getNameFr();
            $n == (count($tempTagArray) - 2) ? $tagString .= ", " : "";
          }
        }

        $filesEntityArray = [];
        $filesEntity = $works[$i]->getFiles();
        for ($n = 0; $n < count($filesEntity); $n++) {
          array_push($filesEntityArray, $filesEntity[$n]);
        }

        dump($filesEntity[0]);

        array_push($worksArray,
            array(
                'id' => $works[$i]->getId(),
                'name' => $works[$i]->getNameFr(),
                'workType' => $works[$i]->getWorkType()->getNameFr(),
                'tags' => $tagString,
                'files' => $works[$i]->getFiles(),
                'filesEntity' => $filesEntityArray
            )
        );
      }

      return $this->render('DocBundle:Work:get.html.twig', array(
            'liste' => $worksArray,
          ));

      return new JsonResponse($worksArray);
  }
}
