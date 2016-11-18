<?php

/**
 * Created by PhpStorm.
 * User: sloum
 * Date: 18/11/2016
 * Time: 11:26
 */
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity
 * @ORM\Table(name="Server")
 * @ORM\Entity(repositoryClass="testServerBundle\Repository\ServerRepository")
 */
class Server
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
     * @ORM\Column(name="emplacement", type="string", length=255, nullable=true,)
     */
    protected $emplacement;
    /**
     * @Assert\NotBlank()
     * @var string
     *
     * @ORM\Column(name="modele", type="string", length=255, nullable=true,)
     */
    protected $modele;
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
    public function getEmplacement()
    {
        return $this->emplacement;
    }

    /**
     * @param string $emplacement
     */
    public function setEmplacement($emplacement)
    {
        $this->emplacement = $emplacement;
    }

    /**
     * @return string
     */
    public function getModele()
    {
        return $this->modele;
    }

    /**
     * @param string $modele
     */
    public function setModele($modele)
    {
        $this->modele = $modele;
    }


}