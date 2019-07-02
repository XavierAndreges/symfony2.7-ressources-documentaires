<?php

namespace DocBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 *
 * @ORM\Table()
 * @ORM\Entity()
 * @UniqueEntity({"idName"})
 */
class TechnoCategory
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * unique name of the TechnoCategory.
     *
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    private $idName;

    /**
     * Name fr of the TechnoCategory.
     *
     * @var string
     *
     * @ORM\Column(type="text", length=65535)
     */
    private $nameFr;


    /**
     * Name En of the TechnoCategory.
     *
     * @var string
     *
     * @ORM\Column(type="text", length=65535)
     */
    private $nameEn;






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
     * Set idName.
     *
     * @param string $idName
     *
     * @return TechnoCategory
     */
    public function setIdName($idName)
    {
        $this->idName = $idName;

        return $this;
    }

    /**
     * Get idName.
     *
     * @return string
     */
    public function getIdName()
    {
        return $this->idName;
    }

    /**
     * Set nameFr.
     *
     * @param string $nameFr
     *
     * @return TechnoCategory
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
     * @return TechnoCategory
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
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->nameFr;
    }
}
