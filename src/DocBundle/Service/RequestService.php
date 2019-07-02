<?php

namespace DocBundle\Service;

use Doctrine\ORM\EntityManager;
use DocBundle\Entity\Work;

class RequestService
{

    private $em;


    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }


    public function getItemsForTags($tags) {

        $qb = $this->em->createQueryBuilder();

/*
        $tag1 = $this->em->getRepository('DocBundle:Tag')
                         ->findOneBy(array('nameFr' => "communication"));

        $array = array($tag1);

        dump($array);

        $qb-> select('w')
           -> from('DocBundle:Work', 'w')
           -> andWhere('w.tags IN (:array)')
           -> setParameter('array', $array);
*/



        $qb -> select('w')
            -> from('DocBundle:Work', 'w');

        $hasAlreadySetOnWhere = false;

        foreach ($tags as $key => $value) {

          if ($value == "communication") {

            $tag1 = $this->em->getRepository('DocBundle:Tag')
                             ->findOneBy(array('nameFr' => $value));

            if ($hasAlreadySetOnWhere) {
              $qb -> andWhere(':tag1 MEMBER OF w.tags')
                  -> setParameter('ta1g', $tag1);
            } else {
              $qb -> where(':tag1 MEMBER OF w.tags')
                  -> setParameter('tag1', $tag1);
              $hasAlreadySetOnWhere = true;
            }
          }


          if ($value == "professionnel") {

            $tag2 = $this->em->getRepository('DocBundle:Tag')
                             ->findOneBy(array('nameFr' => $value));

           if ($hasAlreadySetOnWhere) {
             $qb -> andWhere(':tag2 MEMBER OF w.tags')
                 -> setParameter('tag2', $tag2);
           } else {
             $qb -> where(':tag2 MEMBER OF w.tags')
                 -> setParameter('tag2', $tag2);
             $hasAlreadySetOnWhere = true;
           }

          }


          if ($value == "gestion de projet") {

            $tag3 = $this->em->getRepository('DocBundle:Tag')
                             ->findOneBy(array('nameFr' => $value));

           if ($hasAlreadySetOnWhere) {
             $qb -> andWhere(':tag3 MEMBER OF w.tags')
                 -> setParameter('tag3', $tag3);
           } else {
             $qb -> where(':tag3 MEMBER OF w.tags')
                 -> setParameter('tag3', $tag3);
             $hasAlreadySetOnWhere = true;
           }
          }


          if ($value == "Associatif") {

            $tag4 = $this->em->getRepository('DocBundle:Tag')
                             ->findOneBy(array('nameFr' => $value));

           if ($hasAlreadySetOnWhere) {
             $qb -> andWhere(':tag4 MEMBER OF w.tags')
                 -> setParameter('tag4', $tag4);
           } else {
             $qb -> where(':tag4 MEMBER OF w.tags')
                 -> setParameter('tag4', $tag4);
             $hasAlreadySetOnWhere = true;
           }

          }
        }


        return $qb->getQuery()->getResult();
    }

}
