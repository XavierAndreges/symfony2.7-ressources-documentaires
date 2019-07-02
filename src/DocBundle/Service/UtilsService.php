<?php

namespace DocBundle\Service;

use Doctrine\ORM\EntityManager;

class UtilsService
{

  private $em;


  public function __construct(EntityManager $em)
  {
      $this->em = $em;
  }


  public function isAdmin($request) {
    $routeName = $request->get('_route');
    return strpos($routeName, "admin") !== FALSE ? TRUE : FALSE;
  }


  public function getConcatenateTagsInLine($tags, $symbol) {

      $string = "";

      $i = 0;
      $len = count($tags);

      foreach  ($tags as $tag) {

          $string .= $tag->getNameFr();

          if ($i < $len - 1) {
              $string .= $symbol." ";
          }

          $i++;
      }

      return $string;
  }


  public function getConcatenateTags($tags) {

      $string = "";

      $i = 0;
      $len = count($tags);

      foreach  ($tags as $tag) {

          $string .= $tag->getNameFr();

          if ($i < $len - 1) {
              $string .= "\n";
          }

          $i++;
      }

      return $string;
  }


  public function getConcatenateTechnos($technos) {

    $string = "";

    $i = 0;
    $len = count($technos);

    foreach  ($technos as $techno) {

        $string .= $techno->getName();

        if ($i < $len - 1) {
            $string .= "\n";
        }

        $i++;
    }

    return $string;
  }


  public function getItemsByIdsOrRandom($entity, $rubrique, $cible) {

    $ids = [];
    $items = [];
    $result = [];
    $limit = 3;

    if ($rubrique == "Structure" && $cible == "Work") {

      $items = $entity->getWorks()->toArray();

        switch ($entity->getId()) {
          //Horizons
           case '10': $ids = [29, 25];
             break;
         }

    } else if ($rubrique == "Techno" && $cible == "Work") {

        $items = $entity->getWorks()->toArray();

        $limit = 6;
    }


    if (count($ids) === 0) {

      shuffle($items);

      $result = array_slice($items, 0, $limit);

    } else {

      $i = 0;
      $array = [];

      foreach ($items as $item) {

     //for ($i = 0; $i < count($array); $i++)

          if (in_array($item->getId(), $ids)) {

            $value = array_splice($items, $i, 1);

            array_push($array, $item);

            dump($item->getId());
            dump($value);

            dump($array);
          }

          $i++;
      }

      shuffle($items);
      $result = array_slice(array_merge($array, $items), 0, $limit);
    }




    return $result;

  }


}
