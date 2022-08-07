<?php

namespace ThirdPartyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * ThirdParty
 *
 * @ORM\Table(name="third_party")
 * @ORM\Entity(repositoryClass="ThirdPartyBundle\Repository\ThirdPartyRepository")
 */
class ThirdParty
{
    /**
     * @ORM\OneToMany(targetEntity="DiagnosticBundle\Entity\TurnRatio",
     * mappedBy="thirdParty", cascade={"remove", "persist"})
     * @Groups("thirdParty")
     */
    private $turnRatios;

    /**
     * @ORM\OneToMany(targetEntity="DiagnosticBundle\Entity\Isolement",
     * mappedBy="thirdParty", cascade={"remove", "persist"})
     * @Groups("thirdParty")
     */
    private $isolements;

    /**
     * @ORM\OneToOne(targetEntity="DiagnosticBundle\Entity\Result", 
     * cascade={"persist", "remove"})
     * @Groups("thirdParty")
     */
    private $result;

    /**
     * @ORM\OneToOne(targetEntity="DiagnosticBundle\Entity\InspectionVisuelle", 
     * cascade={"persist", "remove"})
     * @Groups("thirdParty")
     */
    private $inspectionVisuelle;
    
    /**
     * @ORM\ManyToOne(targetEntity="DiagnosticBundle\Entity\Transformer",
     * inversedBy="thirdParties",cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     * @Groups("thirdParty")
     */
    private $transformer;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups("thirdParty")
     */
    private $id;

    /**
     * @var bool
     *
     * @ORM\Column(name="statut", type="boolean")
     * @Groups("thirdParty")
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
     * @Groups("thirdParty")
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
     * @Groups("thirdParty")
     */
    private $conformity;

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
     * @return ThirdParty
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
     * @return ThirdParty
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
     * @Groups("thirdParty")
     */
    public function getKey()
    {
        return $this->keyid;
    }

    /**
     *
     * @Groups("thirdParty")
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
     * @return ThirdParty
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
     * @return ThirdParty
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
     * @return ThirdParty
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
     * Set conformity.
     *
     * @param bool $conformity
     *
     * @return ThirdParty
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
     * @return ThirdParty
     */
    public function addTurnRatio(\DiagnosticBundle\Entity\TurnRatio $turnRatio)
    {
        $this->turnRatios[] = $turnRatio;
        $turnRatio->setThirdParty($this);
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
     * @return ThirdParty
     */
    public function addIsolement(\DiagnosticBundle\Entity\Isolement $isolement)
    {
        $this->isolements[] = $isolement;
        $isolement->setThirdParty($this);
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
     * @return ThirdParty
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
     * @return ThirdParty
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
     * @return ThirdParty
     */
    public function setTransformer(\DiagnosticBundle\Entity\Transformer $transformer = null)
    {
        $this->transformer = $transformer;
        $transformer->addThirdParty($this);
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
