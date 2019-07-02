<?php

namespace DocBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Table(name="files")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class File
{
    public function __construct() {
        $this->works = new \Doctrine\Common\Collections\ArrayCollection();
        $this->structures = new \Doctrine\Common\Collections\ArrayCollection();
        $this->jobs = new \Doctrine\Common\Collections\ArrayCollection();
        $this->technos = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     * @Groups({"file_read"})
     */
    private $fileName;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     * @Groups({"file_read", "work_read"})
     */
    private $nameFr;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     * @Groups({"file_read", "work_read"})
     */
    private $nameEn;


    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     * @Groups({"file_read"})
     */
    private $size;

    /**
     * @var UploadedFile
     * @Groups({"file_read"})
     */
    private $file;

    /**
     * @ORM\ManyToMany(targetEntity="Work", mappedBy="files")
     **/
    private $works;

    /**
     * @ORM\ManyToMany(targetEntity="Structure", mappedBy="files")
     **/
    private $structures;

    /**
     * @ORM\ManyToMany(targetEntity="Job", mappedBy="files")
     **/
    private $jobs;

    /**
     * @ORM\ManyToMany(targetEntity="Techno", mappedBy="files")
     **/
    private $technos;















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
     * Set fileName.
     *
     * @param string $fileName
     *
     * @return file
     */
    public function setFileName($fileName)
    {
        $this->fileName = $fileName;

        return $this;
    }

    /**
     * Get fileName.
     *
     * @return string
     */
    public function getFileName()
    {
        return $this->fileName;
    }

    /**
     * Set nameFr.
     *
     * @param string $nameFr
     *
     * @return file
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
     * @return file
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
     * Set size.
     *
     * @param integer $size
     *
     * @return file
     */
    public function setSize($size)
    {
        $this->size = $size;

        return $this;
    }

    /**
     * Get size.
     *
     * @return integer
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Set file.
     *
     * @param file
     *
     * @return file
     */
    public function setFile($file)
    {
        $this->file = $file;

        return $this;
    }

    /**
     * Get file.
     *
     * @return file
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * set works.
     *
     * @return File
     */
    public function setWorks($works)
    {
        $this->works = $works;

        return $this;
    }

    /**
     * Get works.
     *
     * @return works
     */
    public function getWorks()
    {
        return $this->works;
    }

    /**
     * set structures.
     *
     * @return File
     */
    public function setStructures($structures)
    {
        $this->structures = $structures;

        return $this;
    }

    /**
     * Get structures.
     *
     * @return structures
     */
    public function getStructures()
    {
        return $this->structures;
    }

    /**
     * set jobs.
     *
     * @return File
     */
    public function setJobs($jobs)
    {
        $this->jobs = $jobs;

        return $this;
    }

    /**
     * Get jobs.
     *
     * @return jobs
     */
    public function getJobs()
    {
        return $this->jobs;
    }

    /**
     * set technos.
     *
     * @return File
     */
    public function setTechnos($technos)
    {
        $this->technos = $technos;

        return $this;
    }

    /**
     * Get technos.
     *
     * @return technos
     */
    public function getTechnos()
    {
        return $this->technos;
    }
}