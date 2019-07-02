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
class WorkType
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
     * unique name of the WorkType.
     *
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     * @Groups({"worktype_read"})
     */
    private $idName;

    /**
     * Name fr of the WorkType.
     *
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     * @Groups({"worktype_read"})
     */
    private $nameFr;


    /**
     * Name En of the WorkType.
     *
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     * @Groups({"worktype_read"})
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
     * @return WorkType
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
     * @return WorkType
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
     * @return WorkType
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
