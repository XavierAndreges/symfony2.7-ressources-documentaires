<?php

namespace DocBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 *
 * @ORM\Entity()
 * @ORM\Table()
 */
class Techno
{

    public function __construct() {
        $this->files = new \Doctrine\Common\Collections\ArrayCollection();
        $this->works = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Name of the Techno.
     *
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * description fr of the Techno.
     *
     * @var string
     *
     * @ORM\Column(type="text", length=65535, nullable=true)
     */
    private $textFr;

    /**
     * description En of the Techno.
     *
     * @var string
     *
     * @ORM\Column(type="text", length=65535, nullable=true)
     */
    private $textEn;

    /**
     * website of the Techno.
     *
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $webSite;

    /**
     * category of the techno.
     *
     * @var \TechnoCategory
     *
     * @ORM\ManyToOne(targetEntity="TechnoCategory")
     */
    private $technoCategory;

    /**
     * type of the Work.
     *
     * @var \workType
     *
     * @ORM\ManyToOne(targetEntity="WorkType")
     */
    private $workType;

    /**
     * number of years of experience
     *
     * @var string
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $experienceTime;

    /**
     * started year
     *
     * @var string
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $startedYear;

    /**
     * jobs of the techno.
     *
     * @var \jobs
     *
     * @ORM\ManyToMany(targetEntity="Job", mappedBy="technos")
     */
    private $jobs;

    /**
     * works of the techno.
     *
     * @var \works
     *
     * @ORM\ManyToMany(targetEntity="Work", mappedBy="technos")
     */
    private $works;

    /**
     * @var \files
     *
     * @ORM\ManyToMany(targetEntity="File", inversedBy="technos", cascade={"persist"})
     * @ORM\JoinTable(name="files_technos")
     *
     */
    private $files;

    /**
     * @var ArrayCollection
     */
    private $uploadedFiles;
















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
     * Set name.
     *
     * @param string $name
     *
     * @return Techno
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set textFr.
     *
     * @param string $textFr
     *
     * @return Techno
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
     * @return Techno
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
     * Set webSite.
     *
     * @param string $webSite
     *
     * @return Techno
     */
    public function setWebSite($webSite)
    {
        $this->webSite = $webSite;

        return $this;
    }

    /**
     * Get webSite.
     *
     * @return string
     */
    public function getWebSite()
    {
        return $this->webSite;
    }

    /**
     * Set technoCategory.
     *
     * @param $technoCategory
     *
     * @return Techno
     */
    public function setTechnoCategory($technoCategory)
    {
        $this->technoCategory = $technoCategory;

        return $this;
    }

    /**
     * Get technoCategory.
     *
     * @return workType
     */
    public function getTechnoCategory()
    {
        return $this->technoCategory;
    }

    /**
     * Set type.
     *
     * @param $worktype
     *
     * @return Techno
     */
    public function setWorkType($workType)
    {
        $this->workType = $workType;

        return $this;
    }

    /**
     * Get worktype.
     *
     * @return workType
     */
    public function getWorkType()
    {
        return $this->workType;
    }

    /**
     * Set experienceTime.
     *
     * @param string $name
     *
     * @return Techno
     */
    public function setExperienceTime($experienceTime)
    {
        $this->experienceTime = $experienceTime;

        return $this;
    }

    /**
     * Get experienceTime.
     *
     * @return string
     */
    public function getExperienceTime()
    {
        return $this->experienceTime;
    }

    /**
     * Set startedYear.
     *
     * @param string $name
     *
     * @return Techno
     */
    public function setStartedYear($startedYear)
    {
        $this->startedYear = $startedYear;

        return $this;
    }

    /**
     * Get startedYear.
     *
     * @return string
     */
    public function getStartedYear()
    {
        return $this->startedYear;
    }


    /**
     * set files.
     *
     * @return techno
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
     * @return techno
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
     * set works.
     *
     * @return techno
     */
    public function setWorks($works)
    {
        $this->works = $works;

        return $this;
    }

    /**
     * get works.
     *
     * @return works
     */
    public function getWorks()
    {
        return $this->works;
    }

    /**
     * set jobs.
     *
     * @return techno
     */
    public function setJobs($jobs)
    {
        $this->jobs = $jobs;

        return $this;
    }

    /**
     * get jobs.
     *
     * @return jobs
     */
    public function getJobs()
    {
        return $this->jobs;
    }
}
