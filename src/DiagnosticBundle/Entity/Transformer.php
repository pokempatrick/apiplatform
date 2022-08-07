<?php

namespace DiagnosticBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Transformer
 *
 * @ORM\Table(name="transformer")
 * @ORM\Entity(repositoryClass="DiagnosticBundle\Repository\TransformerRepository")
 * @UniqueEntity("maticule", message="This immatriculation number exist already. {{ value }}")
 * @UniqueEntity(
 *     fields={"serie", "manufacturer"},
 *     message="Un tranformateur existe déja avec ce numéro de serie."
 * )
 */
class Transformer
{
    /**
     * @ORM\OneToMany(targetEntity="DiagnosticBundle\Entity\Diagnostic",
     * mappedBy="transformer", cascade={"remove", "persist"})
     */
    private $diagnostics;

     /**
     * @ORM\OneToMany(targetEntity="StoreEntranceBundle\Entity\StoreEntrance",
     * mappedBy="transformer", cascade={"remove", "persist"})
     */
    private $storeEntrances;

     /**
     * @ORM\OneToMany(targetEntity="ThirdPartyBundle\Entity\ThirdParty",
     * mappedBy="transformer", cascade={"remove", "persist"})
     */
    private $thirdParties;

     /**
     * @ORM\OneToMany(targetEntity="QualityBundle\Entity\Quality",
     * mappedBy="transformer", cascade={"remove", "persist"})
     */
    private $qualities;

     /**
     * @ORM\OneToMany(targetEntity="DowngradingBundle\Entity\Downgrading",
     * mappedBy="transformer", cascade={"remove", "persist"})
     */
    private $downgradings;

     /**
     * @ORM\OneToMany(targetEntity="RepairBundle\Entity\Repair",
     * mappedBy="transformer", cascade={"remove", "persist"})
     */
    private $repairs;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups("transformer")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="serie", type="string", length=255)
     * @Groups("transformer")
     * @Assert\NotBlank(message="This value should be not blank.")
     */
    private $serie;

    /**
     * @var string|null
     *
     * @ORM\Column(name="matricule", type="string", length=255, nullable=true, unique=true)
     * @Groups("transformer")
     */
    private $matricule;

    /**
     * @var string
     *
     * @ORM\Column(name="manufacturer", type="string", length=255)
     * @Groups("transformer")
     */
    private $manufacturer;

    /**
     * @var float|null
     *
     * @ORM\Column(name="tensioncourtcircuit", type="float", nullable=true)
     * @Groups("transformer")
     */
    private $tensioncourtcircuit;

    /**
     * @var float|null
     *
     * @ORM\Column(name="noloadcurent", type="float", nullable=true)
     * @Groups("transformer")
     */
    private $noloadcurent;

    /**
     * @var int
     *
     * @ORM\Column(name="primarytension", type="integer")
     * @Groups("transformer")
     */
    private $primarytension;

    /**
     * @var int
     *
     * @ORM\Column(name="secondarytension", type="integer")
     * @Groups("transformer")
     */
    private $secondarytension;

    /**
     * @var int
     *
     * @ORM\Column(name="puissance", type="integer")
     * @Groups("transformer")
     */
    private $puissance;

    /**
     * @var int|null
     *
     * @ORM\Column(name="secondarycurrent", type="integer", nullable=true)
     * @Groups("transformer")
     */
    private $secondarycurrent;

    /**
     * @var int|null
     *
     * @ORM\Column(name="primarycurrent", type="integer", nullable=true)
     * @Groups("transformer")
     */
    private $primarycurrent;

    /**
     * @var string
     *
     * @ORM\Column(name="couplage", type="string", length=255)
     * @Groups("transformer")
     */
    private $couplage;

    /**
     * @var int|null
     *
     * @ORM\Column(name="year", type="integer", nullable=true)
     * @Groups("transformer")
     */
    private $year;

    /**
     * @var int|null
     *
     * @ORM\Column(name="oil", type="integer", nullable=true)
     * @Groups("transformer")
     */
    private $oil;

    /**
     * @var string
     *
     * @ORM\Column(name="commutateur", type="string")
     * @Groups("transformer")
     */
    private $commutateur;


    /**
     * Get id.
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set serie.
     *
     * @param string $serie
     *
     * @return Transformer
     */
    public function setSerie($serie)
    {
        $this->serie = $serie;

        return $this;
    }

    /**
     * Get serie.
     *
     * @return string
     */
    public function getSerie()
    {
        return $this->serie;
    }

    /**
     * Set matricule.
     *
     * @param string|null $matricule
     *
     * @return Transformer
     */
    public function setMatricule($matricule = null)
    {
        $this->matricule = $matricule;

        return $this;
    }

    /**
     * Get matricule.
     *
     * @return string|null
     */
    public function getMatricule()
    {
        return $this->matricule;
    }

    /**
     * Set manufacturer.
     *
     * @param string $manufacturer
     *
     * @return Transformer
     */
    public function setManufacturer($manufacturer)
    {
        $this->manufacturer = $manufacturer;

        return $this;
    }

    /**
     * Get manufacturer.
     *
     * @return string
     */
    public function getManufacturer()
    {
        return $this->manufacturer;
    }

    /**
     * Set tensioncourtcircuit.
     *
     * @param string|null $tensioncourtcircuit
     *
     * @return Transformer
     */
    public function setTensioncourtcircuit($tensioncourtcircuit = null)
    {
        $this->tensioncourtcircuit = $tensioncourtcircuit;

        return $this;
    }

    /**
     * Get tensioncourtcircuit.
     *
     * @return string|null
     */
    public function getTensioncourtcircuit()
    {
        return $this->tensioncourtcircuit;
    }

    /**
     * Set noloadcurent.
     *
     * @param string|null $noloadcurent
     *
     * @return Transformer
     */
    public function setNoloadcurent($noloadcurent = null)
    {
        $this->noloadcurent = $noloadcurent;

        return $this;
    }

    /**
     * Get noloadcurent.
     *
     * @return string|null
     */
    public function getNoloadcurent()
    {
        return $this->noloadcurent;
    }

    /**
     * Set primarytension.
     *
     * @param string $primarytension
     *
     * @return Transformer
     */
    public function setPrimarytension($primarytension)
    {
        $this->primarytension = $primarytension;

        return $this;
    }

    /**
     * Get primarytension.
     *
     * @return string
     */
    public function getPrimarytension()
    {
        return $this->primarytension;
    }

    /**
     * Set secondarytension.
     *
     * @param string $secondarytension
     *
     * @return Transformer
     */
    public function setSecondarytension($secondarytension)
    {
        $this->secondarytension = $secondarytension;

        return $this;
    }

    /**
     * Get secondarytension.
     *
     * @return string
     */
    public function getSecondarytension()
    {
        return $this->secondarytension;
    }

    /**
     * Set puissance.
     *
     * @param string $puissance
     *
     * @return Transformer
     */
    public function setPuissance($puissance)
    {
        $this->puissance = $puissance;

        return $this;
    }

    /**
     * Get puissance.
     *
     * @return string
     */
    public function getPuissance()
    {
        return $this->puissance;
    }

    /**
     * Set secondarycurrent.
     *
     * @param string|null $secondarycurrent
     *
     * @return Transformer
     */
    public function setSecondarycurrent($secondarycurrent = null)
    {
        $this->secondarycurrent = $secondarycurrent;

        return $this;
    }

    /**
     * Get secondarycurrent.
     *
     * @return string|null
     */
    public function getSecondarycurrent()
    {
        return $this->secondarycurrent;
    }

    /**
     * Set primarycurrent.
     *
     * @param string|null $primarycurrent
     *
     * @return Transformer
     */
    public function setPrimarycurrent($primarycurrent = null)
    {
        $this->primarycurrent = $primarycurrent;

        return $this;
    }

    /**
     * Get primarycurrent.
     *
     * @return string|null
     */
    public function getPrimarycurrent()
    {
        return $this->primarycurrent;
    }

    /**
     * Set couplage.
     *
     * @param string $couplage
     *
     * @return Transformer
     */
    public function setCouplage($couplage)
    {
        $this->couplage = $couplage;

        return $this;
    }

    /**
     * Get couplage.
     *
     * @return string
     */
    public function getCouplage()
    {
        return $this->couplage;
    }

    /**
     * Set year.
     *
     * @param string|null $year
     *
     * @return Transformer
     */
    public function setYear($year = null)
    {
        $this->year = $year;

        return $this;
    }

    /**
     * Get year.
     *
     * @return string|null
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * Set oil.
     *
     * @param string|null $oil
     *
     * @return Transformer
     */
    public function setOil($oil = null)
    {
        $this->oil = $oil;

        return $this;
    }

    /**
     * Get oil.
     *
     * @return string|null
     */
    public function getOil()
    {
        return $this->oil;
    }

    /**
     * Set commutateur.
     *
     * @param string $commutateur
     *
     * @return Transformer
     */
    public function setCommutateur($commutateur)
    {
        $this->commutateur = $commutateur;

        return $this;
    }

    /**
     * Get commutateur.
     *
     * @return string
     */
    public function getCommutateur()
    {
        return $this->commutateur;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->diagnostics = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add diagnostic.
     *
     * @param \DiagnosticBundle\Entity\Diagnostic $diagnostic
     *
     * @return Transformer
     */
    public function addDiagnostic(\DiagnosticBundle\Entity\Diagnostic $diagnostic)
    {
        $this->diagnostics[] = $diagnostic;

        return $this;
    }

    /**
     * Remove diagnostic.
     *
     * @param \DiagnosticBundle\Entity\Diagnostic $diagnostic
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeDiagnostic(\DiagnosticBundle\Entity\Diagnostic $diagnostic)
    {
        return $this->diagnostics->removeElement($diagnostic);
    }

    /**
     * Get diagnostics.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDiagnostics()
    {
        return $this->diagnostics;
    }

    /**
     * Add storeEntrance.
     *
     * @param \StoreEntranceBundle\Entity\StoreEntrance $storeEntrance
     *
     * @return Transformer
     */
    public function addStoreEntrance(\StoreEntranceBundle\Entity\StoreEntrance $storeEntrance)
    {
        $this->storeEntrances[] = $storeEntrance;

        return $this;
    }

    /**
     * Remove storeEntrance.
     *
     * @param \StoreEntranceBundle\Entity\StoreEntrance $storeEntrance
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeStoreEntrance(\StoreEntranceBundle\Entity\StoreEntrance $storeEntrance)
    {
        return $this->storeEntrances->removeElement($storeEntrance);
    }

    /**
     * Get storeEntrances.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getStoreEntrances()
    {
        return $this->storeEntrances;
    }

    /**
     * Add quality.
     *
     * @param \QualityBundle\Entity\Quality $quality
     *
     * @return Transformer
     */
    public function addQuality(\QualityBundle\Entity\Quality $quality)
    {
        $this->qualities[] = $quality;

        return $this;
    }

    /**
     * Remove quality.
     *
     * @param \QualityBundle\Entity\Quality $quality
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeQuality(\QualityBundle\Entity\Quality $quality)
    {
        return $this->qualities->removeElement($quality);
    }

    /**
     * Get qualities.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getQualities()
    {
        return $this->qualities;
    }

    /**
     * Add downgrading.
     *
     * @param \DowngradingBundle\Entity\Downgrading $downgrading
     *
     * @return Transformer
     */
    public function addDowngrading(\DowngradingBundle\Entity\Downgrading $downgrading)
    {
        $this->downgradings[] = $downgrading;

        return $this;
    }

    /**
     * Remove downgrading.
     *
     * @param \DowngradingBundle\Entity\Downgrading $downgrading
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeDowngrading(\DowngradingBundle\Entity\Downgrading $downgrading)
    {
        return $this->downgradings->removeElement($downgrading);
    }

    /**
     * Get downgradings.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDowngradings()
    {
        return $this->downgradings;
    }

    /**
     * Add repair.
     *
     * @param \RepairBundle\Entity\Repair $repair
     *
     * @return Transformer
     */
    public function addRepair(\RepairBundle\Entity\Repair $repair)
    {
        $this->repairs[] = $repair;

        return $this;
    }

    /**
     * Remove repair.
     *
     * @param \RepairBundle\Entity\Repair $repair
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeRepair(\RepairBundle\Entity\Repair $repair)
    {
        return $this->repairs->removeElement($repair);
    }

    /**
     * Get repairs.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRepairs()
    {
        return $this->repairs;
    }

    /**
     * Add thirdParty.
     *
     * @param \ThirdPartyBundle\Entity\ThirdParty $thirdParty
     *
     * @return Transformer
     */
    public function addThirdParty(\ThirdPartyBundle\Entity\ThirdParty $thirdParty)
    {
        $this->thirdParties[] = $thirdParty;

        return $this;
    }

    /**
     * Remove thirdParty.
     *
     * @param \ThirdPartyBundle\Entity\ThirdParty $thirdParty
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeThirdParty(\ThirdPartyBundle\Entity\ThirdParty $thirdParty)
    {
        return $this->thirdParties->removeElement($thirdParty);
    }

    /**
     * Get thirdParties.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getThirdParties()
    {
        return $this->thirdParties;
    }
}
