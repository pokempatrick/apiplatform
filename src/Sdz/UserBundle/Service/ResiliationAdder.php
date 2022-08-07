<?php
 
// src/Sdz/UserBundle/Service/ResiliatonAdder.php
namespace Sdz\UserBundle\Service;
use Symfony\Component\HttpFoundation\Response;



/**
* Service de résiliation d'abonnement pour impayé
**
@author Pokem Ladzou email: pokempatrick@yahoo.fr
*/
class ResiliationAdder
{
	public function addNotice(Response $response, $remainingDays)   
    {    
        $content = $response->getContent();      
        // Code à ajouter       // (Je mets ici du CSS en ligne, mais il faudrait utiliser un fichier CSS 
        // bien sûr !)      
        $html = '<div style="position: fixed; top: 50px; color:red; width: 100%; text-align: center; padding: 0.5em;">Plus que '.(int) $remainingDays.' Jours avant la résiliation!</div>';      
        // Insertion du code dans la page, au début du <body>     
        $content = str_replace('<body class="d-flex flex-column h-100">', '<body > '.$html,$content);     
        // Modification du contenu dans la réponse   
        $response->setContent($content);    
        return $response; 
    }
    public function addTermination(Response $response)   
    {    
        $content = $response->getContent();      
        // Code à ajouter       // (Je mets ici du CSS en ligne, mais il faudrait utiliser un fichier CSS 
        // bien sûr !)      
        $html = '<div style="position: fixed; top: 50px; background: red; width: 100%; text-align: center; padding: 0.5em;">Votre abonnement est résilié. Prière de contacter le fournisseur: pokempatrick@yahoo.fr !</div>';      
        // Insertion du code dans la page, au début du <body>     
        $content = str_replace('<body class="d-flex flex-column h-100">', '<body style="color:#fff"> '.$html, $content);     
        // Modification du contenu dans la réponse   
        $response->setContent($content);    
        return $response; 
    }

}
