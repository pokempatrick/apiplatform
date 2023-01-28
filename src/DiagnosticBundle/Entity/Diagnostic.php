<?php

namespace DiagnosticBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Diagnostic
 *
 * @ORM\Table(name="diagnostic")
 * @ORM\Entity(repositoryClass="DiagnosticBundle\Repository\DiagnosticRepository")
 */
class Diagnostic
{
    /**
     * @ORM\OneToMany(targetEntity="DiagnosticBundle\Entity\TurnRatio",
     * mappedBy="diagnostic", cascade={"remove", "persist"})
     * @Groups("diagnostic")
     */
    private $turnRatios;

    /**
     * @ORM\OneToMany(targetEntity="DiagnosticBundle\Entity\Isolement",
     * mappedBy="diagnostic", cascade={"remove", "persist"})
     * @Groups("diagnostic")
     */
    private $isolements;

    /**
     * @ORM\OneToOne(targetEntity="DiagnosticBundle\Entity\Result", 
     * inversedBy="diagnostic", cascade={"remove", "persist"})
     * @Groups("diagnostic")
     */
    private $result;

    /**
     * @ORM\OneToOne(targetEntity="DiagnosticBundle\Entity\InspectionVisuelle", 
     * inversedBy="diagnostic", cascade={"remove", "persist"})
     * @Groups("diagnostic")
     */
    private $inspectionVisuelle;
    
    /**
     * @ORM\OneToOne(targetEntity="DiagnosticBundle\Entity\InternInspection", 
     * inversedBy="diagnostic", cascade={"remove", "persist"})
     * @Groups("diagnostic")
     */
    private $internInspection;

    /**
     * @ORM\ManyToOne(targetEntity="DiagnosticBundle\Entity\Transformer",
     * inversedBy="diagnostics", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     * @Groups("diagnostic")
     */
    private $transformer;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups("diagnostic")
     */
    private $id;

    /**
     * @var bool
     *
     * @ORM\Column(name="statut", type="boolean")
     * @Groups("diagnostic")
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

    /**
     * @var bool
     *
     * @ORM\Column(name="conformity", type="boolean")
     * @Groups("diagnostic")
     */
    private $conformity;

    /**
     * @var string
     *
     * @ORM\Column(name="next", type="string", length=255, nullable = true)
     * @Groups("diagnostic")
     */
    private $next;

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
     * @return Diagnostic
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
     * @return Diagnostic
     */
    public function setKeyid($keyid)
    {
        $this->keyid = $keyid;

        return $this;
    }

    public function setKey($key)
    {
        $this->keyid = $key;

        return $this;
    }

    /**
     *
     * @Groups("diagnostic")
     */
    public function getKey()
    {
        return $this->keyid;
    }

    /**
     * Get keyid.
     *
     * @return string
     */
    public function getKeyid()
    {
        return $this->keyid;
    }

    /**
     *
     * @Groups("diagnostic")
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
     * @return Diagnostic
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date.
     *
     * @Groups("diagnostic")
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set operateur.
     *
     * @param string $operateur
     *
     * @return Diagnostic
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
     * @return Diagnostic
     */
    public function addTurnRatio(\DiagnosticBundle\Entity\TurnRatio $turnRatio)
    {
        $this->turnRatios[] = $turnRatio;
        $turnRatio->setDiagnostic($this);
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
     * @return Diagnostic
     */
    public function addIsolement(\DiagnosticBundle\Entity\Isolement $isolement)
    {
        $this->isolements[] = $isolement;
        $isolement->setDiagnostic($this);
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
     * @return Diagnostic
     */
    public function setResult(\DiagnosticBundle\Entity\Result $result = null)
    {
        $this->result = $result;
        $result->setDiagnostic($this);

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
     * @return Diagnostic
     */
    public function setInspectionVisuelle(\DiagnosticBundle\Entity\InspectionVisuelle $inspectionVisuelle = null)
    {
        $this->inspectionVisuelle = $inspectionVisuelle;
        $inspectionVisuelle->setDiagnostic($this);

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
     * Set internInspection.
     *
     * @param \DiagnosticBundle\Entity\InternInspection|null $internInspection
     *
     * @return Diagnostic
     */
    public function setInternInspection(\DiagnosticBundle\Entity\InternInspection $internInspection = null)
    {
        $this->internInspection = $internInspection;

        return $this;
    }

    /**
     * Get internInspection.
     *
     * @return \DiagnosticBundle\Entity\InternInspection|null
     */
    public function getInternInspection()
    {
        return $this->internInspection === null ? ""
        :$this->internInspection ;
    }

    /**
     * Set transformer.
     *
     * @param \DiagnosticBundle\Entity\Transformer|null $transformer
     *
     * @return Diagnostic
     */
    public function setTransformer(\DiagnosticBundle\Entity\Transformer $transformer = null)
    {
        $this->transformer = $transformer;
        $transformer->addDiagnostic($this);

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
     * Set createdDate.
     *
     * @param \DateTime $createdDate
     *
     * @return Diagnostic
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
     * Set next.
     *
     * @param string $next
     *
     * @return Diagnostic
     */
    public function setNext($next)
    {
        $this->next = $next;

        return $this;
    }

    /**
     * Get next.
     *
     * @return string
     */
    public function getNext()
    {
        return $this->next;
    }

    /**
     * Set conformity.
     *
     * @param bool $conformity
     *
     * @return Diagnostic
     */
    public function setConformity($conformity)
    {
        $this->conformity = $conformity;

        return $this;
    }

    /**
     * Get conformity.
     *
     * @return bool
     */
    public function getConformity()
    {
        return $this->conformity;
    }
    public function add($a, $b)
    {
        return $a + $b;
    }
}
