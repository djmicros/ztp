<?php

namespace Project\PortalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;

/**
 * Security controller
 *
 * @package     ProjectPortalBundle
 * @author        Adrian Kuciel <kontakt@adriankuciel.pl>
 * @link            http://wierzba.wzks.uj.edu.pl/~10_kuciel/ztp/web
 */
 
class SecurityController extends Controller
{
		    /**
     * Logs user in
     *
     * @return void
     */
	 
    public function LoginAction()
    {
        $request = $this->getRequest();
        $session = $request->getSession();

        // get the login error if there is one
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(
                SecurityContext::AUTHENTICATION_ERROR
            );
        } else {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        }

        return $this->render(
            'ProjectPortalBundle:Security:login.html.twig',
            array(
                // last username entered by the user
                'last_username'
                    => $session->get(SecurityContext::LAST_USERNAME),
                'error'
                    => $error,
            )
        );
    }
		    /**
     * checks login
     *
     * @return void
     */
	
	    public function loginCheckAction()
    {
    }

}