<?php

namespace DocBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;


/**
 *
 * @ORM\Table()
 * @ORM\Entity()
 */
class Structure
{
    public function __construct() {
        $this->jobs = new \Doctrine\Common\Collections\ArrayCollection();
        $this->works = new \Doctrine\Common\Collections\ArrayCollection();
        $this->tags = new \Doctrine\Common\Collections\ArrayCollection();
        $this->files = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Name of the structure.
     *
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * function fr in the structure.
     *
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    private $functionFr;

    /**
     * function En in the structure.
     *
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $functionEn;

    /**
     * city where is the structure.
     *
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $city;

    /**
     * geoloc of the structure.
     *
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $geoloc;

    /**
     * website of the structure.
     *
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $website;

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
     * jobs for that structure
     *
     * @var \Job
     *
     * @ORM\OneToMany(targetEntity="Job", mappedBy="structure")
     */
    private $jobs;

    /**
     * works for that structure
     *
     * @var \Work
     *
     * @ORM\OneToMany(targetEntity="Work", mappedBy="structure")
     */
    private $works;

    /**
     * type of the execution.
     *
     * @var \ExecutionTypes
     *
     * @ORM\ManyToMany(targetEntity="Tag", inversedBy="structures")
     * @ORM\JoinTable(name="tags_structures")
     */
    private $tags;

    /**
     * @var \files
     *
     * @ORM\ManyToMany(targetEntity="File", inversedBy="structures", cascade={"persist"})
     * @ORM\JoinTable(name="files_structures")
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
     * @return Structure
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set functionFr.
     *
     * @param string $functionFr
     *
     * @return Structure
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
     * @return Structure
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
     * Set city.
     *
     * @param string $city
     *
     * @return Structure
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set geoloc.
     *
     * @param string $geoloc
     *
     * @return Structure
     */
    public function setGeoloc($geoloc)
    {
        $this->geoloc = $geoloc;

        return $this;
    }

    /**
     * Get geoloc
     *
     * @return string
     */
    public function getGeoloc()
    {
        return $this->geoloc;
    }

    /**
     * Set website.
     *
     * @param string $website
     *
     * @return Structure
     */
    public function setWebsite($website)
    {
        $this->website = $website;

        return $this;
    }

    /**
     * Get website
     *
     * @return string
     */
    public function getWebsite()
    {
        return $this->website;
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
     * Get jobs.
     *
     * @return Jobs
     */
    public function getJobs()
    {
        return $this->jobs;
    }

    /**
     * Get works.
     *
     * @return Works
     */
    public function getWorks()
    {
        return $this->works;
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
}
