<?php
// src/Sdz/UserBundle/Controller/SecurityController.php;

namespace Sdz\UserBundle\Controller;
use Sdz\UserBundle\Entity\User;
use Sdz\UserBundle\Form\UserType;
use Sdz\UserBundle\Form\UserResetPassType;
use Sdz\UserBundle\Form\UserCheckEmailType;
use Sdz\UserBundle\Form\UserUpdatePassType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class SecurityController extends Controller
{
    public function loginAction(Request $request)
    {   
        // Le service authentication_utils permet de récupérer le nom d'utilisateur
        // et l'erreur dans le cas où le formulaire a déjà été soumis mais était invalide
        // (mauvais mot de passe par exemple)
        $authenticationUtils = $this->get('security.authentication_utils');

        return $this->render('SdzUserBundle:Security:login.html.twig', array(
          'last_username' => $authenticationUtils->getLastUsername(),
          'error'         => $authenticationUtils->getLastAuthenticationError(),
        ));
    }

    public function reset_passwordAction(Request $request)
    {
        $user     = new User();
        $user->setPassword('johndoes')
                ->setName('johndoes')
               ;
         $email_form  = $this->createEmailForm($user);    
        return $this->render('SdzUserBundle:Security:resetpassword.html.twig', array(
            'email_form'=> $email_form->createView(),
            'entity'    => $user,
        ));
    }

    public function send_emailAction(Request $request)
    {
        $user   = new User();
        $user->setPassword('johndoes')
                 ->setName('johndoes')
        ;
        $email_form  = $this->createEmailForm($user);
        $email_form->handleRequest($request);

        if ($email_form->isValid()) {
            $em = $this->getDoctrine()->getManager('user');
            $entity = $em->getRepository('SdzUserBundle:User')->findOneByUsername($user->getUsername());
            if (!$entity) {
                $this->get('session')->getFlashBag()->add('Test', "L'utilisateur: ".$user->getUsername()." n'existe pas.");
                return $this->redirect( $this->generateUrl('reset_password'));
            }else{
              /*code pour la génération du numéro de vérification
              */
                $session = $this->get('session');
                $session->set('code', rand(100000, 999999));
                $code = $session->get('code');

                // code pour l'envoi d'email
                $message = \Swift_Message::newInstance()
                    ->setSubject('Authentification Gestion Quincaillerie')
                    ->setFrom('gestiontransfo@gmail.com')
                    ->setTo($entity->getUsername())
                    ->setBody(
                    $this->renderView(
                            // src/Sdz/UserBundle/Resources/views/Emails/Authentification.html.twig
                            'SdzUserBundle:Emails:authentification.html.twig',
                            array('code' => $code, 'entity'=>$entity)
                        ),
                        'text/html'
                    );
                $this->get('mailer')->send($message);

                $this->get('session')->getFlashBag()->add('info', 'Nous avons envoyé le mail de vérification');
                $check_form = $this->checkEmailForm($entity); 
                return $this->render('SdzUserBundle:Security:checkemail.html.twig', array(
                    'check_form'  => $check_form->createView(),
                    'entity'      => $entity,
            )); 
            }              
           
        }

        return $this->render('SdzUserBundle:Security:resetpassword.html.twig', array(
            'email_form' => $email_form->createView(),
            'entity'=> $user,
        ));
    }

    public function check_emailAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager('user');
        $entity = $em->getRepository('SdzUserBundle:User')->find($id);
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }
        $check_form = $this->checkEmailForm($entity);
        $check_form->handleRequest($request);
        $session = $this->get('session');
        if ($check_form->isValid())
        {
          if($entity->getCode() == $session->get('code')) {
            $session->set('username',$entity->getUsername());
            $this->get('session')->getFlashBag()->add('Test', 'Réinitialiser votre mot de passe');
            return $this->redirect( $this->generateUrl('reset_password_edit',
                array('id' => $entity->getId())) );

          } else{
            $this->get('session')->getFlashBag()->add('Test', 'Code incorrect');
          }
          
        }
        return $this->render('SdzUserBundle:Security:checkemail.html.twig', array(
            'check_form'=> $check_form->createView(),
            'entity'    => $entity,
        ));
    }

    public function editAction(User $entity)
    {
        
        $session = $this->get('session');
        $em = $this->getDoctrine()->getManager('user');
        // $entity = $em->getRepository('SdzUserBundle:User')->find($id);
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }
        if($entity->getUsername() == $session->get('username')|| 
            $entity->getUsername()==$this->getUser()->getUsername())
        {
            
            $editForm = $this->passwordchangeForm($entity);

            return $this->render('SdzUserBundle:Security:updatepassword.html.twig', array(
                'entity'      => $entity,
                'edit_form'   => $editForm->createView(),  
            ));
        } else{
            return $this->redirect( $this->generateUrl('login'));
        }
    }

    public function updateAction(Request $request, $id){
        $em = $this->getDoctrine()->getManager('user');

        $entity = $em->getRepository('SdzUserBundle:User')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }

        $editForm = $this->passwordchangeForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            /*$password = $this->get('security.password_encoder')
                ->encodePassword($entity, $entity->getPassword());*/
            // $entity->setPassword($password);
            $entity->setPasswordRequestedAt(new \Datetime());
            // mail de notification de changement de mot de passe
            $message = \Swift_Message::newInstance()
                    ->setSubject('Notification changement de mot de passe
                                    Gestion Quincaillerie')
                    ->setFrom('gestiontransfo@gmail.com')
                    ->setTo($entity->getUsername())
                    ->setBody(
                    $this->renderView(
                            // src/Sdz/UserBundle/Resources/views/Emails/changepassnotification.html.twig
                            'SdzUserBundle:Emails:changepassnotification.html.twig',
                            array('entity'=>$entity)
                        ),
                        'text/html'
                    );
                $this->get('mailer')->send($message);
            $em->flush();
            // Envoyer une notification pour le changement de mot de passe
            return $this->redirect($this->generateUrl('logout'));
        }

        return $this->render('SdzUserBundle:Security:updatepassword.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }
    

    private function createEmailForm(User $entity)
    {
        $form = $this->createForm('Sdz\UserBundle\Form\UserResetPassType', $entity, array(
            'action' => $this->generateUrl('reset_password_send_email'),
            'method' => 'POST',
            ));

        $form
            ->add('submit', SubmitType::class, array('label' => 'Envoyer'));
        return $form;
    }

    private function checkEmailForm(User $entity)
    {
        $form = $this->createForm('Sdz\UserBundle\Form\UserCheckEmailType', $entity, array(
            'action' => $this->generateUrl('reset_password_check_email', array('id' => $entity->getId())),
            'method' => 'PUT',
            ));
        $form

            ->add('submit', SubmitType::class, array('label' => 'Vérifier'));
        return $form;
    }

    private function passwordchangeForm(User $entity)
    {
        $form = $this->createForm('Sdz\UserBundle\Form\UserUpdatePassType', $entity, array(
            'action' => $this->generateUrl('reset_password_update', array('id' => $entity->getId())),
            'method' => 'POST',
            ));
        $form
            ->add('submit', SubmitType::class, array('label' => 'Update'));
       return $form;
    }
    public function logout1Action(User $user)
    {   
        $em = $this->getDoctrine()->getManager('user');
        $em->flush();  
        return $this->redirect( $this->generateUrl('logout'));
    }
}
  
