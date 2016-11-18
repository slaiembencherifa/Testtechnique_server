<?php

/**
 * Created by PhpStorm.
 * User: sloum
 * Date: 18/11/2016
 * Time: 11:26
 */
namespace testServerBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity
 * @ORM\Table(name="Version")
 * @ORM\Entity(repositoryClass="testServerBundle\Repository\VersionRepository")
 */
class Version
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\generatedValue(strategy="AUTO")
     */
    protected $id;


    /**
     * @Assert\NotBlank()
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255, nullable=true,)
     */
    protected $nom;

    /**
     * @Assert\NotBlank()
     * @var string
     *
     * @ORM\Column(name="numvers", type="string", length=255, nullable=true,)
     */
    protected $numvers;
    /**
     * @ORM\ManyToOne(targetEntity="testServerBundle\Entity\Software", inversedBy="versions" )
     * @ORM\JoinColumn(name="software_id", referencedColumnName="id",onDelete="CASCADE")
     */

    protected $software;

    /**
     * @return string
     */
    public function getNumvers()
    {
        return $this->numvers;
    }

    /**
     * @return mixed
     */
    public function getSoftware()
    {
        return $this->software;
    }

    /**
     * @param mixed $software
     */
    public function setSoftware($software)
    {
        $this->software = $software;
    }

    /**
     * @param string $numvers
     */
    public function setNumvers($numvers)
    {
        $this->numvers = $numvers;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

}