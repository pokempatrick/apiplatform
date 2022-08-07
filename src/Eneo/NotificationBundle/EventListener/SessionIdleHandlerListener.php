<?php
 
// src/Eneo/NotificationBundle/EventListener/SessionIdleHandlerListener.php
namespace Eneo\NotificationBundle\EventListener;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class SessionIdleHandlerListener
{

    protected $session;
    protected $router;
    protected $maxIdleTime;
    protected $securityToken;

    public function __construct(SessionInterface $session, TokenStorageInterface $securityToken, RouterInterface $router, $maxIdleTime = 0)
    {
        $this->session = $session;
        $this->router = $router;
        $this->maxIdleTime = $maxIdleTime;
        $this->securityToken = $securityToken;
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        if (HttpKernelInterface::MASTER_REQUEST != $event->getRequestType()) {

            return;
        }

        if ($this->maxIdleTime > 0) {

            $this->session->start();
            $lapse = time() - $this->session->getMetadataBag()->getLastUsed();

            if ($lapse > $this->maxIdleTime) {
                $this->securityToken->setToken(null);
                $this->session->getFlashBag()->add('info', 'You have been logged out due to inactivity.');
                $event->setResponse(new RedirectResponse($this->router->generate('login')));
            }
        }
    }

}
