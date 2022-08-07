<?php
 
namespace Sdz\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Sdz\UserBundle\Validator\Password;

/**
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="Sdz\UserBundle\Entity\UserRepository")
 * @UniqueEntity("name", message="Utilisateur enregistré avec ce nom")
 * @UniqueEntity("username", message="Adresse Email Existante")
 * @ORM\HasLifecycleCallbacks()
 */
class User implements UserInterface
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="username", type="string", length=255, unique=true)
     * @Assert\Email
     */
    private $username;

    /**
     * @ORM\Column(name="logapikey", type="string", unique=true, nullable=true)
     */
    private $logapikey;

    /**
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * @ORM\Column(name="entreprise", type="string", length=255, nullable=true)
     */
    private $entreprise;

    /**
     * @ORM\Column(name="numeroTelephone", type="integer", nullable=true)
     */
    private $numeroTelephone;

    /**
     * @ORM\Column(name="operateur", type="string", length=255, nullable=true)
     */
    private $operateur;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="creation_date", type="datetime")
     * @Assert\Date
     */
    private $creationDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="limitedaccessdate", type="datetime")
     */
    private $limitedaccessdate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="edited_date", type="datetime")
     * @Assert\Date
     */
    private $editedDate;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255, nullable=true)
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(name="sendername", type="string", length=255, nullable=true)
     */
    private $sendername;

    /**
     * @var string
     *
     * @ORM\Column(name="apikey", type="string", length=255, nullable=true)
     */
    private $apikey;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="password_requested_at", type="datetime")
     * @Assert\Date
     */
    private $password_requested_at;

    private $uncriptedroles;

    private $code;

    /**
     * @ORM\Column(name="password", type="string", length=255)
     * 
     */
    private $password;

    /**
     * @ORM\Column(name="salt", type="string", length=255)
     */
    private $salt;

    /**
     * @var array
     *
     * @ORM\Column(name="roles", type="array")
     */
    private $roles=array();

    // importer de store management

    /**
     * @ORM\Column(name="niuentreprise", type="string", length=255, nullable=true)
     */
    private $niuentreprise;

    /**
     * @ORM\Column(name="nieuser", type="string", length=255, nullable=true)
     */
    private $nieuser;

    /**
     * @ORM\Column(name="magasin", type="string", length=255, nullable=true)
     */
    private $magasin;

    /**
     * @ORM\Column(name="service", type="string", length=255, nullable=true)
     */
    private $service;

    /**
     * @Password()
     */
    private $plainpassword;
    
    // Les getters et setters

    public function __construct()
    {
        $this->salt ='';
        $this->roles =array('anonymous');
        $this->creationDate= new \DateTime();
        $this->editedDate= new \Datetime();
        $this->limitedaccessdate = new \Datetime('January next year');
        $this->service ="school_management" ;
        $this->password_requested_at= new \Datetime();    
    }

    public function eraseCredentials()
    {
    }
    /**
      * @ORM\PreUpdate
      */
    public function updateDate()
    {
      $this->setEditedDate(new \Datetime());
    }
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set username
     *
     * @param string $username
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string 
     */
    public function getUsername()
    {
        return $this->username;
    } 

     public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }
    
    
    public function getUncriptedroles()
    {
        $i=0;
        $transcript=array(
                    'ROLE_SUPER_ADMIN'  =>'Super Administrateur',
                    'ROLE_ADMIN'        =>'Administrateur',
                    // roles school management
                    'ROLE_STUDENT'      =>'Elève',
                    'ROLE_OWNER2'       =>'Propriétaire 2',      
                    'ROLE_OWNER1'       =>'Propriétaire 1',      
                    'ROLE_TEACHER'      =>'Enseignant',      
                    'ROLE_HEAD_TEACHER' =>'Préfet des Etudes',      
                    'ROLE_ACCOUNTANT'   =>'Comptable',
                    // roles store management
                    'ROLE_OWNER'        =>'Propriétaire',      
                    'ROLE_DIRECTOR'     =>'Directeur',
                    'ROLE_SUB_DIRECTOR' =>'Responsable d\'agence',
                    'ROLE_ACCOUNTANT'   =>'Comptable',    
                    'ROLE_SELLER'       =>'Vendeur',    
                    'ROLE_CASHIER'      =>'Caissier',    
                    'ROLE_SECRETARY'    =>'Assistant Propriétaire',    
                    'ROLE_VIEWER'       =>'Observateur', 

                    'anonymous'         =>'anonyme',    
                );

        foreach ($this->roles as $role) {
            $this->uncriptedroles[$i]=$transcript[$role];
            $i++;
        }
        return $this->uncriptedroles;

    }

    public function setUncriptedroles($code)
    {
        $this->uncriptedroles = $uncriptedroles;
        return $this;
    }
    
    
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPlainpassword()
    {
        return $this->plainpassword;
    }

    /**
     * Set name
     *
     * @param string 
     */
    public function setPlainpassword($plainpassword)
    {
        $this->plainpassword = $plainpassword;

        return $this;
    }

    /**
     * Set salt
     *
     * @param string $salt
     * @return User
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;

        return $this;
    }

    /**
     * Get salt
     *
     * @return string 
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return User
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set password_requested_at
     *
     * @param \DateTime $passwordRequestedAt
     * @return User
     */
    public function setPasswordRequestedAt($passwordRequestedAt)
    {
        $this->password_requested_at = $passwordRequestedAt;

        return $this;
    }

    /**
     * Get password_requested_at
     *
     * @return \DateTime 
     */
    public function getPasswordRequestedAt()
    {
        return $this->password_requested_at;
    }


    /**
     * Set roles
     *
     * @param array $roles
     * @return User
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * Get roles
     *
     * @return array 
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * Set operateur
     *
     * @param string $operateur
     * @return User
     */
    public function setOperateur($operateur)
    {
        $this->operateur = $operateur;

        return $this;
    }

    /**
     * Get operateur
     *
     * @return string 
     */
    public function getOperateur()
    {
        return $this->operateur;
    }

    /**
     * Set creationDate
     *
     * @param \DateTime $creationDate
     * @return User
     */
    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    /**
     * Get creationDate
     *
     * @return \DateTime 
     */
    public function getCreationDate()
    {
        return $this->creationDate;
    }

    /**
     * Set editedDate
     *
     * @param \DateTime $editedDate
     * @return User
     */
    public function setEditedDate($editedDate)
    {
        $this->editedDate = $editedDate;

        return $this;
    }

    /**
     * Get editedDate
     *
     * @return \DateTime 
     */
    public function getEditedDate()
    {
        return $this->editedDate;
    }

    /**
     * Set numeroTelephone
     *
     * @param integer $numeroTelephone
     *
     * @return User
     */
    public function setNumeroTelephone($numeroTelephone)
    {
        $this->numeroTelephone = $numeroTelephone;

        return $this;
    }

    /**
     * Get numeroTelephone
     *
     * @return integer
     */
    public function getNumeroTelephone()
    {
        return $this->numeroTelephone;
    }

    /**
     * Set entreprise.
     *
     * @param string|null $entreprise
     *
     * @return User
     */
    public function setEntreprise($entreprise = null)
    {
        $this->entreprise = $entreprise;

        return $this;
    }

    /**
     * Get entreprise.
     *
     * @return string|null
     */
    public function getEntreprise()
    {
        return $this->entreprise;
    }

    /**
     * Set limitedaccessdate.
     *
     * @param \DateTime|null $limitedaccessdate
     *
     * @return User
     */
    public function setLimitedaccessdate($limitedaccessdate)
    {
        $this->limitedaccessdate = $limitedaccessdate;

        return $this;
    }

    /**
     * Get limitedaccessdate.
     *
     * @return \DateTime|null
     */
    public function getLimitedaccessdate()
    {
        return $this->limitedaccessdate;
    }

    /**
     * Set url.
     *
     * @param string|null $url
     *
     * @return User
     */
    public function setUrl($url = null)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url.
     *
     * @return string|null
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set sendername.
     *
     * @param string|null $sendername
     *
     * @return User
     */
    public function setSendername($sendername = null)
    {
        $this->sendername = $sendername;

        return $this;
    }

    /**
     * Get sendername.
     *
     * @return string|null
     */
    public function getSendername()
    {
        return $this->sendername;
    }

    /**
     * Set apikey.
     *
     * @param string|null $apikey
     *
     * @return User
     */
    public function setApikey($apikey = null)
    {
        $this->apikey = $apikey;

        return $this;
    }

    /**
     * Get apikey.
     *
     * @return string|null
     */
    public function getApikey()
    {
        return $this->apikey;
    }

    /**
     * Set niuentreprise.
     *
     * @param string|null $niuentreprise
     *
     * @return User
     */
    public function setNiuentreprise($niuentreprise = null)
    {
        $this->niuentreprise = $niuentreprise;

        return $this;
    }

    /**
     * Get niuentreprise.
     *
     * @return string|null
     */
    public function getNiuentreprise()
    {
        return $this->niuentreprise;
    }

    /**
     * Set nieuser.
     *
     * @param string|null $nieuser
     *
     * @return User
     */
    public function setNieuser($nieuser = null)
    {
        $this->nieuser = $nieuser;

        return $this;
    }

    /**
     * Get nieuser.
     *
     * @return string|null
     */
    public function getNieuser()
    {
        return $this->nieuser;
    }

    /**
     * Set magasin.
     *
     * @param string|null $magasin
     *
     * @return User
     */
    public function setMagasin($magasin = null)
    {
        $this->magasin = $magasin;

        return $this;
    }

    /**
     * Get magasin.
     *
     * @return string|null
     */
    public function getMagasin()
    {
        return $this->magasin;
    }

    /**
     * Set service.
     *
     * @param string|null $service
     *
     * @return User
     */
    public function setService($service = null)
    {
        $this->service = $service;

        return $this;
    }

    /**
     * Get service.
     *
     * @return string|null
     */
    public function getService()
    {
        return $this->service;
    }

    /**
     * Set logapikey.
     *
     * @param string $logapikey
     *
     * @return User
     */
    public function setLogapikey($logapikey)
    {
        $this->logapikey = $logapikey;

        return $this;
    }

    /**
     * Get logapikey.
     *
     * @return string
     */
    public function getLogapikey()
    {
        return $this->logapikey;
    }
}
