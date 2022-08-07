<?php

namespace DiagnosticBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * InternInspection
 *
 * @ORM\Table(name="intern_inspection")
 * @ORM\Entity(repositoryClass="DiagnosticBundle\Repository\InternInspectionRepository")
 */
class InternInspection
{
    /**
     * @ORM\OneToOne(targetEntity="DiagnosticBundle\Entity\Diagnostic", 
     * mappedBy="internInspection")
     */
    private $diagnostic;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups("internInspection")
     */
    private $id;

    /**
     * @var bool
     *
     * @ORM\Column(name="offLoadAdjuster", type="boolean")
     * @Groups("internInspection")
     */
    private $offLoadAdjuster;

    /**
     * @var bool
     *
     * @ORM\Column(name="winding", type="boolean")
     * @Groups("internInspection")
     */
    private $winding;

    /**
     * @var bool
     *
     * @ORM\Column(name="magneticCircuit", type="boolean")
     * @Groups("internInspection")
     */
    private $magneticCircuit;

    /**
     * @var bool
     *
     * @ORM\Column(name="solidInsolation", type="boolean")
     * @Groups("internInspection")
     */
    private $solidInsolation;

    /**
     * @var int
     *
     * @ORM\Column(name="oil", type="boolean")
     * @Groups("internInspection")
     */
    private $oil;

    /**
     * @var int|null
     *
     * @ORM\Column(name="breakdownVoltage", type="integer", nullable=true)
     * @Groups("internInspection")
     */
    private $breakdownVoltage;

    /**
     * @var string
     *
     * @ORM\Column(name="testPCB", type="string", length=255)
     
     */
    private $testPCB;


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
     * Set offLoadAdjuster.
     *
     * @param bool $offLoadAdjuster
     *
     * @return InternInspection
     */
    public function setOffLoadAdjuster($offLoadAdjuster)
    {
        $this->offLoadAdjuster = $offLoadAdjuster;

        return $this;
    }

    /**
     * Get offLoadAdjuster.
     *
     * @return bool
     */
    public function getOffLoadAdjuster()
    {
        return $this->offLoadAdjuster;
    }

    /**
     * Set winding.
     *
     * @param bool $winding
     *
     * @return InternInspection
     */
    public function setWinding($winding)
    {
        $this->winding = $winding;

        return $this;
    }

    /**
     * Get winding.
     *
     * @return bool
     */
    public function getWinding()
    {
        return $this->winding;
    }

    /**
     * Set magneticCircuit.
     *
     * @param bool $magneticCircuit
     *
     * @return InternInspection
     */
    public function setMagneticCircuit($magneticCircuit)
    {
        $this->magneticCircuit = $magneticCircuit;

        return $this;
    }

    /**
     * Get magneticCircuit.
     *
     * @return bool
     */
    public function getMagneticCircuit()
    {
        return $this->magneticCircuit;
    }

    /**
     * Set solidInsolation.
     *
     * @param bool $solidInsolation
     *
     * @return InternInspection
     */
    public function setSolidInsolation($solidInsolation)
    {
        $this->solidInsolation = $solidInsolation;

        return $this;
    }

    /**
     * Get solidInsolation.
     *
     * @return bool
     */
    public function getSolidInsolation()
    {
        return $this->solidInsolation;
    }


    /**
     * Set breakdownVoltage.
     *
     * @param string $breakdownVoltage
     *
     * @return InternInspection
     */
    public function setBreakdownVoltage($breakdownVoltage)
    {
        $this->breakdownVoltage = $breakdownVoltage;

        return $this;
    }

    /**
     * Get breakdownVoltage.
     *
     * @return string
     */
    public function getBreakdownVoltage()
    {
        return $this->breakdownVoltage;
    }

    /**
     * Set testPCB.
     *
     * @param string $testPCB
     *
     * @return InternInspection
     */
    public function setTestPCB($testPCB)
    {
        $this->testPCB = $testPCB;

        return $this;
    }

    /**
     * Get testPCB.
     *
     * @return string
     */
    public function getTestPCB()
    {
        return $this->testPCB;
    }


    /**
     * Set oil.
     *
     * @param bool $oil
     *
     * @return InternInspection
     */
    public function setOil($oil)
    {
        $this->oil = $oil;

        return $this;
    }

    /**
     * Get oil.
     *
     * @return bool
     */
    public function getOil()
    {
        return $this->oil;
    }

    /**
     * Set diagnostic.
     *
     * @param \DiagnosticBundle\Entity\Diagnostic|null $diagnostic
     *
     * @return InternInspection
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
