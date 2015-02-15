<?php
namespace Project\PortalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Project\PortalBundle\Form\Type;
use Project\PortalBundle\Entity\User;

class UserController extends Controller
{

	/**
     * @Route("/")


	public function indexAction()
    {

		$repository = $this->getDoctrine()
		->getRepository('ProjectPortalBundle:Post');
		
		$posts = $repository->findAll();

		return $this->render('ProjectPortalBundle:Post:index.html.twig', array('posts' => $posts ));
    }
		*/     


	public function viewAction($user_id)
    {
		
			 /**
     * @Route("/view/{post_id}")
	     */

	    $current_user = $this->getDoctrine()
        ->getRepository('ProjectPortalBundle:User')
        ->find($user_id);

    if (!$current_user) {
        throw $this->createNotFoundException(
            'No user found for id in the database '.$user_id
        );
    }
	
				 /**
    if (!in_array($post_id, $posts)) {
        throw $this->createNotFoundException('The post does not exist');
    }
	
	$current_post = $posts[$post_id];
	*/
        return $this->render('ProjectPortalBundle:User:view.html.twig', array('user' => $current_user ));
    }

	    public function addAction(Request $request)
    {

        $user = new User();
        $postForm = $this->createForm(new Type\UserType(), $user);

        if ($request->isMethod('post')) {

            $postForm->bindRequest($request);

            if ($postForm->isValid()) {

                $user = $postForm->getData();
		

				
				$em = $this->getDoctrine()->getManager();

					$em->persist($user);
					$em->flush();
					$user_id = $user->getId();
				
				        $request->getSession()->getFlashBag()->add(
            'notice',
            'User registered!'
        );
				
		$repository = $this->getDoctrine()
		->getRepository('ProjectPortalBundle:Post');
		
		$posts = $repository->findAll();

		return $this->render('ProjectPortalBundle:User:view.html.twig', array('user_id' => $user_id));

	

    if (!in_array($post_id, $posts)) {
        throw $this->createNotFoundException('The post does not exist');
    }
	
	$current_post = $posts[$post_id];
	

            }

        }

        return $this->render('ProjectPortalBundle:Post:add.html.twig', array('form' => $postForm->createView()));
    } 

}