<?php 

namespace DocBundle\Entity;
 
use Doctrine\ORM\Mapping as ORM;
 
/**
 * @ORM\Table()
 * @ORM\Entity
 */
class Client
{
 
	/**
	 * @ORM\Column(name="id", type="integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="IDENTITY")
	 */
	private $id;
	 
	/**
	 * @ORM\Column(name="nom", type="string", length=45, nullable=true)
	 */
	private $nom;
	 
	/**
	 * @ORM\OneToOne(targetEntity="Carte", inversedBy="client", cascade={"persist", "merge", "remove"})
	 * @ORM\JoinColumn(name="Carte_id", referencedColumnName="id")
	 */
	private $carte;
	 
	/**
	 * @return int
	 */
	public function getId()
	{
		return $this->id;
	}
	 
	/**
	 * @param string $nom
	 */
	public function setNom($nom)
	{
		$this->nom = $nom;
	}
	 
	/**
	 * @return string
	 */
	public function getNom()
	{
		return $this->nom;
	}
	 
	/**
	 * @param $carte
	 */
	public function setCarte($carte)
	{
		$this->carte = $carte;
	}
	 
	/**
	 * @return Client
	 */
	public function getCarte()
	{
		return $this->carte;
	}
}
