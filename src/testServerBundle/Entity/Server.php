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
 * @ORM\Table(name="Server")
 * @ORM\Entity(repositoryClass="testServerBundle\Repository\ServerRepository")
 */
class Server
{
    /**
     * @return mixed
     */
    public function getVersions()
    {
        return $this->versions;
    }

    /**
     * @param mixed $versions
     */
    public function setVersions($versions)
    {
        $this->versions = $versions;
    }
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\generatedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToMany(targetEntity="\testServerBundle\Entity\Version", cascade={"persist"})
     *
     */
    protected $versionsimplementees;

    /**
     * @return \Doctrine\Common\Collections\Collection|Version[]
     */
    public function getVersionsimplementees()
    {
        return $this->versionsimplementees;
    }

    /**
     * @param \Doctrine\Common\Collections\Collection|Version[] $versionsimplementees
     */
    public function setVersionsimplementees($versionsimplementees)
    {
        $this->versionsimplementees = $versionsimplementees;
    }

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
/* ajouter une version au serveur */
    public function addVersion(\testServerBundle\Entity\Version $version)
    {
        if ($this->versionsimplementees->contains($version)) {
            return;
        }
        $this->versionsimplementees->add($version);
    }
    /*retirer une version d'un serveur*/

    public function removeVersion(\testServerBundle\Entity\Version $version)
    {
        $this->versionsimplementees->removeElement($version);
    }

}