<?php

namespace DowngradingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Downgrading
 *
 * @ORM\Table(name="downgrading")
 * @ORM\Entity(repositoryClass="DowngradingBundle\Repository\DowngradingRepository")
 */
class Downgrading
{
    /**
     * @ORM\ManyToOne(targetEntity="DiagnosticBundle\Entity\Transformer",
     * inversedBy="downgradings", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     * @Groups("downgrading")
     */
    private $transformer;
    
    /**
     * @ORM\OneToOne(targetEntity="RepairBundle\Entity\SparePart", 
     * cascade={"persist","remove"})
     * @Groups("downgrading")
     */
    private $sparePart;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups("downgrading")
     */
    private $id;

    /**
     * @var bool
     *
     * @ORM\Column(name="statut", type="boolean")
     * @Groups("downgrading")
     */
    private $statut;

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

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     * @Groups("downgrading")
     */
    private $date;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdDate", type="datetime")
     */
    private $createdDate;

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
     * @return Downgrading
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
     * Set keyid.
     *
     * @param string $keyid
     *
     * @return Downgrading
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
     * @Groups("downgrading")
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
     * @Groups("downgrading")
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
     * Set date.
     *
     * @param \DateTime $date
     *
     * @return Downgrading
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
     * @return Downgrading
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
     * Set transformer.
     *
     * @param \DiagnosticBundle\Entity\Transformer|null $transformer
     *
     * @return Downgrading
     */
    public function setTransformer(\DiagnosticBundle\Entity\Transformer $transformer = null)
    {
        $this->transformer = $transformer;
        $transformer->addDowngrading($this);
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
     * @return Downgrading
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

    /**
     * Set operateur.
     *
     * @param string $operateur
     *
     * @return Downgrading
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
}
