<?php

namespace DocBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 *
 * @ORM\Entity(repositoryClass="DocBundle\Entity\Repository\WorkRepository")
 * @ORM\Table()
 */
class Work
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
     * Name fr of the Work.
     *
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    private $nameFr;

    /**
     * Name En of the Work.
     *
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nameEn;

    /**
     * type of the Work.
     *
     * @var \workType
     *
     * @ORM\ManyToOne(targetEntity="WorkType", cascade={"persist"})
     */
    private $workType;

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
     * city where the work has been done.
     *
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $city;

    /**
     * geoloc of the work.
     *
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $geoloc;

    /**
     * type of the execution.
     *
     * @var \tags
     *
     * @ORM\ManyToMany(targetEntity="Tag", inversedBy="works")
     * @ORM\JoinTable(name="tags_works")
     */
    private $tags;

    /**
     * @var \files
     *
     * @ORM\ManyToMany(targetEntity="File", inversedBy="works", cascade={"persist"})
     * @ORM\JoinTable(name="files_works")
     * @Groups({"work_read"})
     *
     */
    private $files;

    /**
     * @var ArrayCollection
     */
    private $uploadedFiles;

    /**
     * website of the work.
     *
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $website;

    /**
     * link 1 to the video of the work.
     *
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $linkVideo1;

    /**
     * link 2 to the video of the work.
     *
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $linkVideo2;

    /**
     * job of the works.
     *
     * @var \job
     *
     * @ORM\ManyToOne(targetEntity="Job")
     */
    private $job;

    /**
     * structure of the works.
     *
     * @var \structure
     *
     * @ORM\ManyToOne(targetEntity="Structure")
     */
    private $structure;

    /**
     * technos of the work
     *
     * @var \technos
     *
     * @ORM\ManyToMany(targetEntity="Techno", inversedBy="works")
     * @ORM\JoinTable(name="techno_works")
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
     * Set nameFr.
     *
     * @param string $nameFr
     *
     * @return Work
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
     * @return Work
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
     * Set type.
     *
     * @param $worktype
     *
     * @return work
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
     * Set website.
     *
     * @param string $website
     *
     * @return work
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
     * Set linkVideo1.
     *
     * @param string $linkVideo1
     *
     * @return work
     */
    public function setLinkVideo1($linkVideo1)
    {
        $this->linkVideo1 = $linkVideo1;

        return $this;
    }

    /**
     * Get linkVideo1
     *
     * @return string
     */
    public function getLinkVideo1()
    {
        return $this->linkVideo1;
    }

    /**
     * Set linkVideo2.
     *
     * @param string $linkVideo2
     *
     * @return work
     */
    public function setLinkVideo2($linkVideo2)
    {
        $this->linkVideo2 = $linkVideo2;

        return $this;
    }

    /**
     * Get linkVideo2
     *
     * @return string
     */
    public function getLinkVideo2()
    {
        return $this->linkVideo2;
    }

    /**
     * Set job.
     *
     * @param job
     *
     * @return Work
     */
    public function setJob($job)
    {
        $this->job = $job;

        return $this;
    }

    /**
     * Get job.
     *
     * @return job
     */
    public function getJob()
    {
        return $this->job;
    }

    /**
     * Set structure.
     *
     * @param structure
     *
     * @return Work
     */
    public function setStructure($structure)
    {
        $this->structure = $structure;

        return $this;
    }

    /**
     * Get jstructureob.
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
        return $this->nameFr;
    }
}
