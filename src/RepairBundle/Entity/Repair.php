<?php

namespace RepairBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Repair
 *
 * @ORM\Table(name="repair")
 * @ORM\Entity(repositoryClass="RepairBundle\Repository\RepairRepository")
 */
class Repair
{
    /**
     * @ORM\ManyToOne(targetEntity="DiagnosticBundle\Entity\Transformer",
     * inversedBy="repairs", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     * @Groups("repair")
     */
    private $transformer;
    
    /**
     * @ORM\OneToOne(targetEntity="RepairBundle\Entity\SparePart", 
     * cascade={"persist", "remove"})
     * @Groups("repair")
     */
    private $sparePart;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups("repair")
     */
    private $id;

    /**
     * @var bool
     *
     * @ORM\Column(name="statut", type="boolean")
     * @Groups("repair")
     */
    private $statut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     * @Groups("repair")
     */
    private $date;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdDate", type="datetime")
     */
    private $createdDate;

    /**
     * @var string
     *
     * @ORM\Column(name="keyid", type="string", length=255)
     */
    private $keyid;

    /**
     * @var string
     *
     * @ORM\Column(name="operateur", type="string", length=255)
     */
    private $operateur;

    private $previousId;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->createdDate = new \Datetime(); // Date de création
    }

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
     * Set statut.
     *
     * @param bool $statut
     *
     * @return Repair
     */
    public function setStatut($statut)
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * Get statut.
     *
     * @return bool
     */
    public function getStatut()
    {
        return $this->statut;
    }

    /**
     * Set date.
     *
     * @param \DateTime $date
     *
     * @return Repair
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date.
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set createdDate.
     *
     * @param \DateTime $createdDate
     *
     * @return Repair
     */
    public function setCreatedDate($createdDate)
    {
        $this->createdDate = $createdDate;

        return $this;
    }

    /**
     * Get createdDate.
     *
     * @return \DateTime
     */
    public function getCreatedDate()
    {
        return $this->createdDate;
    }

    /**
     * Set keyid.
     *
     * @param string $keyid
     *
     * @return Repair
     */
    public function setKeyid($keyid)
    {
        $this->keyid = $keyid;

        return $this;
    }

    /**
     * Get keyid.
     *
     * @return string
     * @Groups("repair")
     */
    public function getKeyid()
    {
        return $this->keyid;
    }

    public function setKey($key)
    {
        $this->keyid = $key;

        return $this;
    }

    /**
     *
     * @Groups("repair")
     */
    public function getPreviousId()
    {
        return $this->previousId;
    }

    public function setPreviousId($previousId)
    {
        $this->previousId = $previousId;
        return $this;
    }
    /**
     * Set operateur.
     *
     * @param string $operateur
     *
     * @return Repair
     */
    public function setOperateur($operateur)
    {
        $this->operateur = $operateur;

        return $this;
    }

    /**
     * Get operateur.
     *
     * @return string
     */
    public function getOperateur()
    {
        return $this->operateur;
    }

    /**
     * Set transformer.
     *
     * @param \DiagnosticBundle\Entity\Transformer|null $transformer
     *
     * @return Repair
     */
    public function setTransformer(\DiagnosticBundle\Entity\Transformer $transformer = null)
    {
        $this->transformer = $transformer;
        $transformer->addRepair($this);
        return $this;
    }

    /**
     * Get transformer.
     *
     * @return \DiagnosticBundle\Entity\Transformer|null
     */
    public function getTransformer()
    {
        return $this->transformer;
    }

    /**
     * Set sparePart.
     *
     * @param \RepairBundle\Entity\SparePart|null $sparePart
     *
     * @return Repair
     */
    public function setSparePart(\RepairBundle\Entity\SparePart $sparePart = null)
    {
        $this->sparePart = $sparePart;

        return $this;
    }

    /**
     * Get sparePart.
     *
     * @return \RepairBundle\Entity\SparePart|null
     */
    public function getSparePart()
    {
        return $this->sparePart;
    }
}
