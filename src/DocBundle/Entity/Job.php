<?php

namespace DocBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity()
 * @ORM\Table()
 */
class Job
{
    public function __construct() {
        $this->tags = new \Doctrine\Common\Collections\ArrayCollection();
        $this->files = new \Doctrine\Common\Collections\ArrayCollection();
        $this->technos = new \Doctrine\Common\Collections\ArrayCollection();
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
     * function fr of the Work.
     *
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    private $functionFr;

    /**
     * function En of the Work.
     *
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $functionEn;

    /**
     * text fr of the Work.
     *
     * @var string
     *
     * @ORM\Column(type="text", length=65535, nullable=true)
     */
    private $textFr;

    /**
     * function En of the Work.
     *
     * @var string
     *
     * @ORM\Column(type="text", length=65535, nullable=true)
     */
    private $textEn;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateStart;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateEnd;

    /**
     * type of the execution.
     *
     * @var \tags
     *
     * @ORM\ManyToMany(targetEntity="Tag", inversedBy="jobs")
     * @ORM\JoinTable(name="tags_jobs")
     */
    private $tags;

    /**
     * @var \files
     *
     * @ORM\ManyToMany(targetEntity="File", inversedBy="jobs", cascade={"persist"})
     * @ORM\JoinTable(name="files_jobs")
     *
     */
    private $files;

    /**
     * @var ArrayCollection
     */
    private $uploadedFiles;

    /**
     * structure of the job.
     *
     * @var \structure
     *
     * @ORM\ManyToOne(targetEntity="Structure", inversedBy="jobs")
     * @ORM\JoinColumn(name="job_structure", referencedColumnName="id")
     */
    private $structure;

    /**
     * technos of the job
     *
     * @var \technos
     *
     * @ORM\ManyToMany(targetEntity="Techno", inversedBy="jobs")
     * @ORM\JoinTable(name="techno_jobs")
     */
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
     * Set functionFr.
     *
     * @param string $functionFr
     *
     * @return Work
     */
    public function setFunctionFr($functionFr)
    {
        $this->functionFr = $functionFr;

        return $this;
    }

    /**
     * Get functionFr.
     *
     * @return string
     */
    public function getFunctionFr()
    {
        return $this->functionFr;
    }

    /**
     * Set functionEn.
     *
     * @param string $functionEn
     *
     * @return Work
     */
    public function setFunctionEn($functionEn)
    {
        $this->functionEn = $functionEn;

        return $this;
    }

    /**
     * Get functionEn.
     *
     * @return string
     */
    public function getFunctionEn()
    {
        return $this->functionEn;
    }

    /**
     * Set textFr.
     *
     * @param string $textFr
     *
     * @return Work
     */
    public function setTextFr($textFr)
    {
        $this->textFr = $textFr;

        return $this;
    }

    /**
     * Get textFr.
     *
     * @return string
     */
    public function getTextFr()
    {
        return $this->textFr;
    }

    /**
     * Set textEn.
     *
     * @param string $textEn
     *
     * @return Work
     */
    public function setTextEn($textEn)
    {
        $this->textEn = $textEn;

        return $this;
    }

    /**
     * Get textEn.
     *
     * @return string
     */
    public function getTextEn()
    {
        return $this->textEn;
    }

    /**
     * Set dateStart.
     *
     * @param \DateTime $dateStart
     *
     * @return Work
     */
    public function setDateStart($dateStart)
    {
        $this->dateStart = $dateStart;

        return $this;
    }

    /**
     * Get dateStart.
     *
     * @return \DateTime
     */
    public function getDateStart()
    {
        return $this->dateStart;
    }

    /**
     * Set dateEnd.
     *
     * @param \DateTime $dateEnd
     *
     * @return Work
     */
    public function setDateEnd($dateEnd)
    {
        $this->dateEnd = $dateEnd;

        return $this;
    }

    /**
     * Get dateEnd.
     *
     * @return \DateTime
     */
    public function getDateEnd()
    {
        return $this->dateEnd;
    }

    /**
     * Set tag.
     *
     * @param $tags
     *
     * @return work
     */
    public function setTags($tags)
    {
        $this->tags = $tags;

        return $this;
    }

    /**
     * Get tags.
     *
     * @return tags
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * set files.
     *
     * @return work
     */
    public function setFiles($files)
    {
        $this->files = $files;

        return $this;
    }

    /**
     * get files.
     *
     * @return files
     */
    public function getFiles()
    {
        return $this->files;
    }

    /**
     * set uploadedFiles.
     *
     * @return work
     */
    public function setUploadedFiles($uploadedFiles)
    {
        $this->uploadedFiles = $uploadedFiles;

        return $this;
    }

    /**
     * get uploadedFiles.
     *
     * @return uploadedFiles
     */
    public function getUploadedFiles()
    {
        return $this->uploadedFiles;
    }

    /**
     * Set structure.
     *
     * @param $structure
     *
     * @return Job
     */
    public function setStructure($structure)
    {
        $this->structure = $structure;

        return $this;
    }

    /**
     * Get structure.
     *
     * @return structure
     */
    public function getStructure()
    {
        return $this->structure;
    }

    /**
     * Set technos.
     *
     * @param $technos
     *
     * @return work
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


    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return explode("@", $this->functionFr)[0];
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getNameProject()
    {
        return explode("@", $this->functionFr)[1];
    }
}
