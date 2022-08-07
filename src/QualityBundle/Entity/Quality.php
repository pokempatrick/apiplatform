<?php

namespace QualityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Quality
 *
 * @ORM\Table(name="quality")
 * @ORM\Entity(repositoryClass="QualityBundle\Repository\QualityRepository")
 */
class Quality
{
    /**
     * @ORM\OneToMany(targetEntity="DiagnosticBundle\Entity\TurnRatio",
     * mappedBy="quality", cascade={"remove", "persist"})
     * @Groups("quality")
     */
    private $turnRatios;

    /**
     * @ORM\OneToMany(targetEntity="DiagnosticBundle\Entity\Isolement",
     * mappedBy="quality", cascade={"remove", "persist"})
     * @Groups("quality")
     */
    private $isolements;

    /**
     * @ORM\OneToOne(targetEntity="DiagnosticBundle\Entity\Result", 
     * cascade={"persist", "remove"})
     * @Groups("quality")
     */
    private $result;

    /**
     * @ORM\OneToOne(targetEntity="DiagnosticBundle\Entity\InspectionVisuelle", 
     * cascade={"persist","remove"})
     * @Groups("quality")
     */
    private $inspectionVisuelle;
    
    /**
     * @ORM\ManyToOne(targetEntity="DiagnosticBundle\Entity\Transformer",
     * inversedBy="qualities", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     * @Groups("quality")
     */
    private $transformer;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups("quality")
     */
    private $id;

    /**
     * @var bool
     *
     * @ORM\Column(name="statut", type="boolean")
     * @Groups("quality")
     */
    private $statut;

    /**
     * @var string
     *
     * @ORM\Column(name="keyid", type="string", length=255)
     */
    private $keyid;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     * @Groups("quality")
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
     * @ORM\Column(name="operateur", type="string", length=255)
     */
    private $operateur;

    private $previousId;

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
     * @return Quality
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
     * @return Quality
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
     * @Groups("quality")
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
     * @Groups("quality")
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
     * @return Quality
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
     * @return Quality
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
     * Set operateur.
     *
     * @param string $operateur
     *
     * @return Quality
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
     * Constructor
     */
    public function __construct()
    {
        $this->turnRatios = new \Doctrine\Common\Collections\ArrayCollection();
        $this->isolements = new \Doctrine\Common\Collections\ArrayCollection();
        $this->createdDate = new \Datetime(); // Date de création
    }

    /**
     * Add turnRatio.
     *
     * @param \DiagnosticBundle\Entity\TurnRatio $turnRatio
     *
     * @return Quality
     */
    public function addTurnRatio(\DiagnosticBundle\Entity\TurnRatio $turnRatio)
    {
        $this->turnRatios[] = $turnRatio;
        $turnRatio->setQuality($this);
        return $this;
    }

    /**
     * Remove turnRatio.
     *
     * @param \DiagnosticBundle\Entity\TurnRatio $turnRatio
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeTurnRatio(\DiagnosticBundle\Entity\TurnRatio $turnRatio)
    {
        return $this->turnRatios->removeElement($turnRatio);
    }

    /**
     * Get turnRatios.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTurnRatios()
    {
        return $this->turnRatios;
    }

    /**
     * Add isolement.
     *
     * @param \DiagnosticBundle\Entity\Isolement $isolement
     *
     * @return Quality
     */
    public function addIsolement(\DiagnosticBundle\Entity\Isolement $isolement)
    {
        $this->isolements[] = $isolement;
        $isolement->setQuality($this);
        return $this;
    }

    /**
     * Remove isolement.
     *
     * @param \DiagnosticBundle\Entity\Isolement $isolement
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeIsolement(\DiagnosticBundle\Entity\Isolement $isolement)
    {
        return $this->isolements->removeElement($isolement);
    }

    /**
     * Get isolements.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIsolements()
    {
        return $this->isolements;
    }

    /**
     * Set result.
     *
     * @param \DiagnosticBundle\Entity\Result|null $result
     *
     * @return Quality
     */
    public function setResult(\DiagnosticBundle\Entity\Result $result = null)
    {
        $this->result = $result;

        return $this;
    }

    /**
     * Get result.
     *
     * @return \DiagnosticBundle\Entity\Result|null
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * Set inspectionVisuelle.
     *
     * @param \DiagnosticBundle\Entity\InspectionVisuelle|null $inspectionVisuelle
     *
     * @return Quality
     */
    public function setInspectionVisuelle(\DiagnosticBundle\Entity\InspectionVisuelle $inspectionVisuelle = null)
    {
        $this->inspectionVisuelle = $inspectionVisuelle;

        return $this;
    }

    /**
     * Get inspectionVisuelle.
     *
     * @return \DiagnosticBundle\Entity\InspectionVisuelle|null
     */
    public function getInspectionVisuelle()
    {
        return $this->inspectionVisuelle;
    }

    /**
     * Set transformer.
     *
     * @param \DiagnosticBundle\Entity\Transformer|null $transformer
     *
     * @return Quality
     */
    public function setTransformer(\DiagnosticBundle\Entity\Transformer $transformer = null)
    {
        $this->transformer = $transformer;
        $transformer->addQuality($this);
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
}
