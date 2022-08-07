<?php
// src/Sdz/UserBundle/EventListener/ResiliatonListener.php
namespace Sdz\UserBundle\EventListener;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Sdz\UserBundle\Service\ResiliationAdder;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
/**
* Listener de résiliation d'abonnement
**
@author Pokem Ladzou email: pokempatrick@yahoo.fr
*/
class ResiliationListener
{
    private $resiliationAdder;
    private $tokenstorage;

    public function __construct(ResiliationAdder $resiliationAdder, $tokenstorage)  
    {
        $this->resiliationAdder     =$resiliationAdder;    
        $this->tokenstorage         =$tokenstorage;  
    }

	public function processWarning(FilterResponseEvent $event)  {
        if (!$event->isMasterRequest() ||
            $this->tokenstorage->getToken()===null ||
            !is_object($this->tokenstorage->getToken()->getUser())) { 
            return;    
        }        
                
        $user=$this->tokenstorage->getToken()->getUser();
        $remainingDays =date_diff(new \Datetime(), $user->getLimitedaccessdate())->format("%R%a");   
        if (in_array('ROLE_SUPER_ADMIN', $user->getRoles())
            ||in_array('ROLE_ADMIN', $user->getRoles())
            || $remainingDays>=20) 
        {      
            return;    
        }    
        // On utilise notre BetaHRML. 
        if($remainingDays > 0){
            // notification
            $response=$this->resiliationAdder->addNotice($event->getResponse(), $remainingDays);
        }else{
            // résiliation
            $response=$this->resiliationAdder->addTermination($event->getResponse());
        }    
        // On met à jour la réponse avec la nouvelle valeur.    
        $event->setResponse($response);  
    }
}
