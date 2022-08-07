<?php

namespace DiagnosticBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Result
 *
 * @ORM\Table(name="result")
 * @ORM\Entity(repositoryClass="DiagnosticBundle\Repository\ResultRepository")
 */
class Result
{
    /**
     * @ORM\OneToOne(targetEntity="DiagnosticBundle\Entity\Diagnostic", 
     * mappedBy="result")
     */
    private $diagnostic;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups("result")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="anomalie", type="text")
     * @Groups("result")
     */
    private $anomalie;

    /**
     * @var string
     *
     * @ORM\Column(name="conclusion", type="string", length=255)
     * @Groups("result")
     */
    private $conclusion;

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
     * Set anomalie.
     *
     * @param string $anomalie
     *
     * @return Result
     */
    public function setAnomalie($anomalie)
    {
        $this->anomalie = $anomalie;

        return $this;
    }

    /**
     * Get anomalie.
     *
     * @return string
     */
    public function getAnomalie()
    {
        return $this->anomalie;
    }

    /**
     * Set conclusion.
     *
     * @param string $conclusion
     *
     * @return Result
     */
    public function setConclusion($conclusion)
    {
        $this->conclusion = $conclusion;

        return $this;
    }

    /**
     * Get conclusion.
     *
     * @return string
     */
    public function getConclusion()
    {
        return $this->conclusion;
    }

    /**
     * Set date.
     *
     * @param \DateTime $date
     *
     * @return Result
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
     * @return Result
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
     * @return Result
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
