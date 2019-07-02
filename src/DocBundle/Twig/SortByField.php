<?php

namespace DocBundle\Twig;

class SortByField extends \Twig_Extension
{

    public function getName()
    {
        return 'sortbyfield_extension';
    }


    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('sortByField', array($this, 'sortByField')),
        );
    }


    public function sortByField($array, $fieldName)
    {
        $tempArray = $array->toArray();

        dump($tempArray[0]);

        if ($fieldName == "startedYear") {

          usort($tempArray,  function ($a, $b)  {

              if ($a->getStartedYear() == $b->getStartedYear()) {
                  return 0;
              }

              return ($a->getStartedYear() < $b->getStartedYear()) ? 1 : -1;

            });

        }

        return $tempArray;
    }
}
