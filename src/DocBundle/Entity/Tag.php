<?php

namespace DocBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 *
 * @ORM\Table()
 * @ORM\Entity()
 */
class Tag
{
    public function __construct() {
        $this->works = new \Doctrine\Common\Collections\ArrayCollection();
        $this->structures = new \Doctrine\Common\Collections\ArrayCollection();
        $this->jobs = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * Name fr of the executionType.
     *
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    private $nameFr;

    /**
     * Name En of the executionType.
     *
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    private $nameEn;

    /**
     * @ORM\ManyToMany(targetEntity="Work", mappedBy="tags")
     */
    private $works;

    /**
     * @ORM\ManyToMany(targetEntity="Structure", mappedBy="tags")
     */
    private $structures;

    /**
     * @ORM\ManyToMany(targetEntity="Job", mappedBy="tags")
     */
    private $jobs;













    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nameFr.
     *
     * @param string $nameFr
     *
     * @return nameFr
     */
    public function setNameFr($nameFr)
    {
        $this->nameFr = $nameFr;

        return $this;
    }

    /**
     * Get nameFr.
     *
     * @return string
     */
    public function getNameFr()
    {
        return $this->nameFr;
    }

    /**
     * Set nameEn.
     *
     * @param string $nameEn
     *
     * @return nameEn
     */
    public function setNameEn($nameEn)
    {
        $this->nameEn = $nameEn;

        return $this;
    }

    /**
     * Get nameEn.
     *
     * @return string
     */
    public function getNameEn()
    {
        return $this->nameEn;
    }

    /**
     * Get works.
     *
     * @return array
     */
    public function getWorks()
    {
        return $this->works;
    }

    /**
     * Get structures.
     *
     * @return array
     */
    public function getStructures()
    {
        return $this->structures;
    }

    /**
     * Get jobs.
     *
     * @return array
     */
    public function getJobs()
    {
        return $this->jobs;
    }

    /**
     * Get nameFr.
     *
     * @return string
     */
    public function getName()
    {
        return $this->nameFr;
    }
}
