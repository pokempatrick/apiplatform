<?php

namespace DiagnosticBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * TurnRatio
 *
 * @ORM\Table(name="turn_ratio")
 * @ORM\Entity(repositoryClass="DiagnosticBundle\Repository\TurnRatioRepository")
 */
class TurnRatio
{
    /**
     * @ORM\ManyToOne(targetEntity="DiagnosticBundle\Entity\Diagnostic",
     * inversedBy="turnRatios")
     * @ORM\JoinColumn(nullable=true)
     */
    private $diagnostic;

    /**
     * @ORM\ManyToOne(targetEntity="QualityBundle\Entity\Quality",
     * inversedBy="turnRatios")
     * @ORM\JoinColumn(nullable=true)
     */
    private $quality;

    /**
     * @ORM\ManyToOne(targetEntity="ThirdPartyBundle\Entity\ThirdParty",
     * inversedBy="turnRatios")
     * @ORM\JoinColumn(nullable=true)
     */
    private $thirdParty;
    
    /**
     * @ORM\ManyToOne(targetEntity="StoreEntranceBundle\Entity\StoreEntrance",
     * inversedBy="turnRatios")
     * @ORM\JoinColumn(nullable=true)
     */
    private $storeEntrance;
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups("turnRatio")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="bobine", type="string", length=255)
     * @Groups("turnRatio")
     */
    private $bobine;

    /**
     * @var float
     *
     * @ORM\Column(name="ratio", type="float")
     * @Groups("turnRatio")
     */
    private $ratio;

    /**
     * @var int
     *
     * @ORM\Column(name="tension", type="integer")
     * @Groups("turnRatio")
     */
    private $tension;

    /**
     * @var string
     *
     * @ORM\Column(name="equipment", type="string", length=255)
     * @Groups("turnRatio")
     */
    private $equipment;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="operateur", type="string", length=255)
     */
    private $operateur;

    /**
     * @var string
     *
     * @ORM\Column(name="keyid", type="string", length=255)
     */
    private $keyid;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->date = new \Datetime(); // Date de création
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
     * Set bobine.
     *
     * @param string $bobine
     *
     * @return TurnRatio
     */
    public function setBobine($bobine)
    {
        $this->bobine = $bobine;

        return $this;
    }

    /**
     * Get bobine.
     *
     * @return string
     */
    public function getBobine()
    {
        return $this->bobine;
    }

    /**
     * Set ratio.
     *
     * @param float $ratio
     *
     * @return TurnRatio
     */
    public function setRatio($ratio)
    {
        $this->ratio = $ratio;

        return $this;
    }

    /**
     * Get ratio.
     *
     * @return float
     */
    public function getRatio()
    {
        return $this->ratio;
    }

    /**
     * Set tension.
     *
     * @param int $tension
     *
     * @return TurnRatio
     */
    public function setTension($tension)
    {
        $this->tension = $tension;

        return $this;
    }

    /**
     * Get tension.
     *
     * @return int
     */
    public function getTension()
    {
        return $this->tension;
    }

    /**
     * Set date.
     *
     * @param \DateTime $date
     *
     * @return TurnRatio
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
     * Set operateur.
     *
     * @param string $operateur
     *
     * @return TurnRatio
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
     * Set keyid.
     *
     * @param string $keyid
     *
     * @return TurnRatio
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
     * @Groups("turnRatio")
     */
    public function getKey()
    {
        return $this->keyid;
    }

    /**
     * Set diagnostic.
     *
     * @param \DiagnosticBundle\Entity\Diagnostic|null $diagnostic
     *
     * @return TurnRatio
     */
    public function setDiagnostic(\DiagnosticBundle\Entity\Diagnostic $diagnostic = null)
    {
        $this->diagnostic = $diagnostic;
        return $this;
    }

    /**
     * Get diagnostic.
     *
     * @return \DiagnosticBundle\Entity\Diagnostic|null
     */
    public function getDiagnostic()
    {
        return $this->diagnostic;
    }

    /**
     * Set quality.
     *
     * @param \QualityBundle\Entity\Quality|null $quality
     *
     * @return TurnRatio
     */
    public function setQuality(\QualityBundle\Entity\Quality $quality = null)
    {
        $this->quality = $quality;

        return $this;
    }

    /**
     * Get quality.
     *
     * @return \QualityBundle\Entity\Quality|null
     */
    public function getQuality()
    {
        return $this->quality;
    }

    /**
     * Set thirdParty.
     *
     * @param \ThirdPartyBundle\Entity\ThirdParty|null $thirdParty
     *
     * @return TurnRatio
     */
    public function setThirdParty(\ThirdPartyBundle\Entity\ThirdParty $thirdParty = null)
    {
        $this->thirdParty = $thirdParty;

        return $this;
    }

    /**
     * Get thirdParty.
     *
     * @return \ThirdPartyBundle\Entity\ThirdParty|null
     */
    public function getThirdParty()
    {
        return $this->thirdParty;
    }

    /**
     * Set storeEntrance.
     *
     * @param \StoreEntranceBundle\Entity\StoreEntrance|null $storeEntrance
     *
     * @return TurnRatio
     */
    public function setStoreEntrance(\StoreEntranceBundle\Entity\StoreEntrance $storeEntrance = null)
    {
        $this->storeEntrance = $storeEntrance;

        return $this;
    }

    /**
     * Get storeEntrance.
     *
     * @return \StoreEntranceBundle\Entity\StoreEntrance|null
     */
    public function getStoreEntrance()
    {
        return $this->storeEntrance;
    }

    /**
     * Set equipment.
     *
     * @param string $equipment
     *
     * @return TurnRatio
     */
    public function setEquipment($equipment)
    {
        $this->equipment = $equipment;

        return $this;
    }

    /**
     * Get equipment.
     *
     * @return string
     */
    public function getEquipment()
    {
        return $this->equipment;
    }
}
