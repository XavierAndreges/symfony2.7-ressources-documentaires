<?php

namespace DocBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * fuck
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class fuck
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
}
