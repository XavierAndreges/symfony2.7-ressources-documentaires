<?php

namespace DocBundle\Entity;
 
use Doctrine\ORM\Mapping as ORM;
 
/**
 * @ORM\Table()
 * @ORM\Entity
 */
class Carte
{
 
	/**
	 * @ORM\Column(name="id", type="integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="IDENTITY")
	 */
	private $id;
	 
	/**
	 * @ORM\Column(name="type", type="string", length=45, nullable=true)
	 */
	private $type;

	/**
     * @ORM\OneToOne(targetEntity="Client", mappedBy="carte")
     */
    private $client;



	 
	/**
	 * @return int
	 */
	public function getId()
	{
		return $this->id;
	}
	 
	/**
	 * @param string $type
	 */
	public function setType($type)
	{
		$this->type = $type;
	}
	 
	/**
	 * @return string
	 */
	public function getType()
	{
		return $this->type;
	}


	/**
	 * @param $client
	 */
	public function setClient($client)
	{
		$this->client = $client;
	}
	 
	/**
	 * @return Carte
	 */
	public function getClient()
	{
		return $this->client;
	}
}