<?php

namespace DiagnosticBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Isolement
 *
 * @ORM\Table(name="isolement")
 * @ORM\Entity(repositoryClass="DiagnosticBundle\Repository\IsolementRepository")
 */
class Isolement
{
    /**
     * @ORM\ManyToOne(targetEntity="DiagnosticBundle\Entity\Diagnostic",
     * inversedBy="isolements")
     * @ORM\JoinColumn(nullable=true)
     */
    private $diagnostic;

    /**
     * @ORM\ManyToOne(targetEntity="QualityBundle\Entity\Quality",
     * inversedBy="isolements")
     * @ORM\JoinColumn(nullable=true)
     */
    private $quality;

    /**
     * @ORM\ManyToOne(targetEntity="ThirdPartyBundle\Entity\ThirdParty",
     * inversedBy="isolements")
     * @ORM\JoinColumn(nullable=true)
     */
    private $thirdParty;
    
    /**
     * @ORM\ManyToOne(targetEntity="StoreEntranceBundle\Entity\StoreEntrance",
     * inversedBy="isolements")
     * @ORM\JoinColumn(nullable=true)
     */
    private $storeEntrance;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups("isolement")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="tension", type="integer")
     * @Groups("isolement")
     */
    private $tension;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255)
     * @Groups("isolement")
     */
    private $type;

    /**
     * @var int
     *
     * @ORM\Column(name="temps", type="integer")
     * @Groups("isolement")
     */
    private $temps;

    /**
     * @var int
     *
     * @ORM\Column(name="isolement", type="integer")
     * @Groups("isolement")
     */
    private $isolement;

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
     * @var string
     *
     * @ORM\Column(name="operateur", type="string", length=255)
     */
    private $operateur;
    
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
     * Set tension.
     *
     * @param int $tension
     *
     * @return Isolement
     */
    public function setTension($tension)
    {
        $this->tension =(int) $tension;

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
     * Set type.
     *
     * @param string $type
     *
     * @return Isolement
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type.
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set temps.
     *
     * @param int $temps
     *
     * @return Isolement
     */
    public function setTemps($temps)
    {
        $this->temps =  $temps;

        return $this;
    }

    /**
     * Get temps.
     *
     * @return int
     */
    public function getTemps()
    {
        return $this->temps;
    }

    /**
     * Set isolement.
     *
     * @param float $isolement
     *
     * @return Isolement
     */
    public function setIsolement($isolement)
    {
        $this->isolement = $isolement;

        return $this;
    }

    /**
     * Get isolement.
     *
     * @return float
     */
    public function getIsolement()
    {
        return $this->isolement;
    }

    /**
     * Set keyid.
     *
     * @param string $keyid
     *
     * @return Isolement
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
     * @Groups("isolement")
     */
    public function getKey()
    {
        return $this->keyid;
    }

    /**
     * Set date.
     *
     * @param \DateTime $date
     *
     * @return Isolement
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
     * @return Isolement
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
     * Set diagnostic.
     *
     * @param \DiagnosticBundle\Entity\Diagnostic|null $diagnostic
     *
     * @return Isolement
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
     * @return Isolement
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
     * @return Isolement
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
     * @return Isolement
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
}
