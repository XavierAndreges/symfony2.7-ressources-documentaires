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
class HomeController extends Controller
{

  /**
   * Lists all Job entities.
   *
   */
  public function indexAction(Request $request)
  {
    $em = $this->getDoctrine()->getManager();
    
/*

      $work = $em->getRepository('DocBundle:Work')->find(36);
      dump($work->getTags()->toArray());
*/

      dump($request->request->all());

      $entities = [];

      $tags = $em ->getRepository('DocBundle:Tag')->findAll();

      $tagSelection = $request->request->get('tagSelection');

      if ($tagSelection != null && count($tagSelection) > 0) {
          $entities = $this->get('doc.request')->getItemsForTags($tagSelection);
      } else {
        //$entities = $this->get('doc.request')->getItemsForTags(null);
      }

      dump($entities);

      return $this->render('DocBundle:Home:index.html.twig', array(
          'entities' => $entities,
          'tags' => $tags,
          'tagSelection' => $tagSelection
      ));
  }

}
