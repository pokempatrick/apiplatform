<?php

namespace DiagnosticBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * InspectionVisuelle
 *
 * @ORM\Table(name="inspection_visuelle")
 * @ORM\Entity(repositoryClass="DiagnosticBundle\Repository\InspectionVisuelleRepository")
 */
class InspectionVisuelle
{
    /**
     * @ORM\OneToOne(targetEntity="DiagnosticBundle\Entity\Diagnostic", 
     * mappedBy="inspectionVisuelle")
     */
    private $diagnostic;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups("inspectionVisuelle")
     */
    private $id;

    /**
     * @var bool
     *
     * @ORM\Column(name="borneBT", type="boolean")
     * @Groups("inspectionVisuelle")
     */
    private $borneBT;

    /**
     * @var bool
     *
     * @ORM\Column(name="borneHTA", type="boolean")
     * @Groups("inspectionVisuelle")
     */
    private $borneHTA;

    /**
     * @var string
     *
     * @ORM\Column(name="partieActive", type="boolean")
     * @Groups("inspectionVisuelle")
     */
    private $partieActive;

    /**
     * @var bool
     *
     * @ORM\Column(name="fuiteHuile", type="boolean")
     * @Groups("inspectionVisuelle")
     */
    private $fuiteHuile;

    /**
     * @var string
     *
     * @ORM\Column(name="other", type="text")
     * @Groups("inspectionVisuelle")
     */
    private $other;

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
     * Set borneBT.
     *
     * @param bool $borneBT
     *
     * @return InspectionVisuelle
     */
    public function setBorneBT($borneBT)
    {
        $this->borneBT = $borneBT;

        return $this;
    }

    /**
     * Get borneBT.
     *
     * @return bool
     */
    public function getBorneBT()
    {
        return $this->borneBT;
    }

    /**
     * Set borneHTA.
     *
     * @param bool $borneHTA
     *
     * @return InspectionVisuelle
     */
    public function setBorneHTA($borneHTA)
    {
        $this->borneHTA = $borneHTA;

        return $this;
    }

    /**
     * Get borneHTA.
     *
     * @return bool
     */
    public function getBorneHTA()
    {
        return $this->borneHTA;
    }

    /**
     * Set fuiteHuile.
     *
     * @param bool $fuiteHuile
     *
     * @return InspectionVisuelle
     */
    public function setFuiteHuile($fuiteHuile)
    {
        $this->fuiteHuile = $fuiteHuile;

        return $this;
    }

    /**
     * Get fuiteHuile.
     *
     * @return bool
     */
    public function getFuiteHuile()
    {
        return $this->fuiteHuile;
    }

    /**
     * Set other.
     *
     * @param string $other
     *
     * @return InspectionVisuelle
     */
    public function setOther($other)
    {
        $this->other = $other;

        return $this;
    }

    /**
     * Get other.
     *
     * @return string
     */
    public function getOther()
    {
        return $this->other;
    }

    /**
     * Set date.
     *
     * @param \DateTime $date
     *
     * @return InspectionVisuelle
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
     * @return InspectionVisuelle
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
     * Set partieActive.
     *
     * @param bool $partieActive
     *
     * @return InspectionVisuelle
     */
    public function setPartieActive($partieActive)
    {
        $this->partieActive = $partieActive;

        return $this;
    }

    /**
     * Get partieActive.
     *
     * @return bool
     */
    public function getPartieActive()
    {
        return $this->partieActive;
    }

    /**
     * Set diagnostic.
     *
     * @param \DiagnosticBundle\Entity\Diagnostic|null $diagnostic
     *
     * @return InspectionVisuelle
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
}
