<?php
// src/UserBundle/TokenAuthenticator.php
namespace Sdz\UserBundle\Service;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\RouterInterface;

class TokenAuthenticator extends AbstractGuardAuthenticator
{
    private $doctrine;
    private $userPasswordEncoder;
    private $router;

    public function __construct(Registry $doctrine, 
            UserPasswordEncoder $userPasswordEncoder, RouterInterface $router)
    {
        $this->doctrine = $doctrine;
        $this->userPasswordEncoder = $userPasswordEncoder;
        $this->router = $router;
    }
    public function supports(Request $request)
    {
        return $request->headers->has('X-AUTH-TOKEN');
    }

    /**
     * Called on every request. Return whatever credentials you want to
     * be passed to getUser() as $credentials.
     */
    public function getCredentials(Request $request)
    {
        if (!$logapikey = $request->headers->get('X-AUTH-TOKEN')) 
        {
            // no token? Return null and no other methods will be called
            return;
        }
        // What you return here will be passed to getUser() as $credentials
        return array(
            'logapikey'  => $logapikey,
        );
    }

    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        $logapikey = $credentials['logapikey'];
        $em = $this->doctrine->getManager('user');
        // if null, authentication will fail
        // if a User object, checkCredentials() is called
        return $em->getRepository('SdzUserBundle:User')
                    ->findOneByLogapikey($logapikey);
    }

    public function checkCredentials($credentials, UserInterface $user)
    {
        // check credentials - e.g. make sure the password is valid
        // no credential check is needed in this case

        // return true to cause authentication success
        return true;
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
        // on success, let the request continue

        return null;
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        $data = [
            // you may want to customize or obfuscate the message first
            'message' => strtr($exception->getMessageKey(), $exception->getMessageData())

            // or to translate this message
            // $this->translator->trans($exception->getMessageKey(), $exception->getMessageData())
        ];

        return new JsonResponse($data, 403);
    }

    /**
     * Called when authentication is needed, but it's not sent
     */
    public function start(Request $request, AuthenticationException $authException = null)
    {
        $data = [
            // you might translate this message
            'message' => 'Authentication Required'
        ];

        return new JsonResponse($data, 401);
    }

    public function supportsRememberMe()
    {
        return false;
    }
}