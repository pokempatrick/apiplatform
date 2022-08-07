<?php

namespace RepairBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * SparePart
 *
 * @ORM\Table(name="spare_part")
 * @ORM\Entity(repositoryClass="RepairBundle\Repository\SparePartRepository")
 */
class SparePart
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups("sparePart")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="oilQuantity", type="integer", nullable=true)
     * @Groups("sparePart")
     */
    private $oilQuantity;

    /**
     * @var int
     *
     * @ORM\Column(name="oilBreakdownVoltage", type="integer", nullable=true)
     * @Groups("sparePart")
     */
    private $oilBreakdownVoltage;

    /**
     * @var string
     *
     * @ORM\Column(name="oilTank", type="string", length=255, nullable=true)
     * @Groups("sparePart")
     */
    private $oilTank;

    /**
     * @var int
     *
     * @ORM\Column(name="windings", type="integer", length=255)
     * @Groups("sparePart")
     */
    private $windings;

    /**
     * @var int
     *
     * @ORM\Column(name="HTAETerminal", type="integer", length=255)
     * @Groups("sparePart")
     */
    private $hTAETerminal;

    /**
     * @var int
     *
     * @ORM\Column(name="HTAPTerminals", type="integer", length=255)
     * @Groups("sparePart")
     */
    private $hTAPTerminals;

    /**
     * @var bool
     *
     * @ORM\Column(name="offLaodAdjuster", type="boolean")
     * @Groups("sparePart")
     */
    private $offLaodAdjuster;

    /**
     * @var bool
     *
     * @ORM\Column(name="connexion", type="boolean")
     * @Groups("sparePart")
     */
    private $connexion;

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
     */
    private $date;

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
     * Set oilQuantity.
     *
     * @param int $oilQuantity
     *
     * @return SparePart
     */
    public function setOilQuantity($oilQuantity)
    {
        $this->oilQuantity = $oilQuantity;

        return $this;
    }

    /**
     * Get oilQuantity.
     *
     * @return int
     */
    public function getOilQuantity()
    {
        return $this->oilQuantity;
    }

    /**
     * Set oilBreakdownVoltage.
     *
     * @param int $oilBreakdownVoltage
     *
     * @return SparePart
     */
    public function setOilBreakdownVoltage($oilBreakdownVoltage)
    {
        $this->oilBreakdownVoltage = $oilBreakdownVoltage;

        return $this;
    }

    /**
     * Get oilBreakdownVoltage.
     *
     * @return int
     */
    public function getOilBreakdownVoltage()
    {
        return $this->oilBreakdownVoltage;
    }

    /**
     * Set oilTank.
     *
     * @param string $oilTank
     *
     * @return SparePart
     */
    public function setOilTank($oilTank)
    {
        $this->oilTank = $oilTank;

        return $this;
    }

    /**
     * Get oilTank.
     *
     * @return string
     */
    public function getOilTank()
    {
        return $this->oilTank;
    }

    /**
     * Set windings.
     *
     * @param string $windings
     *
     * @return SparePart
     */
    public function setWindings($windings)
    {
        $this->windings = $windings;

        return $this;
    }

    /**
     * Get windings.
     *
     * @return string
     */
    public function getWindings()
    {
        return $this->windings;
    }

    /**
     * Set hTAETerminal.
     *
     * @param string $hTAETerminal
     *
     * @return SparePart
     */
    public function setHTAETerminal($hTAETerminal)
    {
        $this->hTAETerminal = $hTAETerminal;

        return $this;
    }

    /**
     * Get hTAETerminal.
     *
     * @return string
     */
    public function getHTAETerminal()
    {
        return $this->hTAETerminal;
    }

    /**
     * Set hTAPTerminals.
     *
     * @param string $hTAPTerminals
     *
     * @return SparePart
     */
    public function setHTAPTerminals($hTAPTerminals)
    {
        $this->hTAPTerminals = $hTAPTerminals;

        return $this;
    }

    /**
     * Get hTAPTerminals.
     *
     * @return string
     */
    public function getHTAPTerminals()
    {
        return $this->hTAPTerminals;
    }

    /**
     * Set connexion.
     *
     * @param bool $connexion
     *
     * @return SparePart
     */
    public function setConnexion($connexion)
    {
        $this->connexion = $connexion;

        return $this;
    }

    /**
     * Get connexion.
     *
     * @return bool
     */
    public function getConnexion()
    {
        return $this->connexion;
    }

    /**
     * Set operateur.
     *
     * @param string $operateur
     *
     * @return SparePart
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
     * Set date.
     *
     * @param \DateTime $date
     *
     * @return SparePart
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
     * Set offLaodAdjuster.
     *
     * @param bool $offLaodAdjuster
     *
     * @return SparePart
     */
    public function setOffLaodAdjuster($offLaodAdjuster)
    {
        $this->offLaodAdjuster = $offLaodAdjuster;

        return $this;
    }

    /**
     * Get offLaodAdjuster.
     *
     * @return bool
     */
    public function getOffLaodAdjuster()
    {
        return $this->offLaodAdjuster;
    }
}
