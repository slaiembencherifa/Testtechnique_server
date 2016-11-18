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
 * @ORM\Table(name="Software")
 * @ORM\Entity(repositoryClass="testServerBundle\Repository\SoftwareRepository")
 */
class Software
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
     * @ORM\Column(name="nom", type="string", length=255)
     */
    protected $nom;
    /**
     * @Assert\NotBlank()
     * @var string
     * @ORM\Column(name="editeur", type="string", length=255, nullable=true)
     */
    protected $editeur;
    /**
     * @Assert\NotBlank()
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true,)
     */
    protected $description;
    /**
     * @ORM\OneToMany(targetEntity="testServerBundle\Entity\Version", mappedBy="id", cascade={"all"})
     * @ORM\JoinColumn(nullable=true, onDelete="CASCADE")
     */

    protected $versions;


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

    /**
     * @return string
     */
    public function getEditeur()
    {
        return $this->editeur;
    }

    /**
     * @param string $editeur
     */
    public function setEditeur($editeur)
    {
        $this->editeur = $editeur;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }
}