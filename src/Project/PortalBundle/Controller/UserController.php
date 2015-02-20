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
        $userForm = $this->createForm(new Type\UserType(), $user);

        if ($request->isMethod('post')) {

            $userForm->bindRequest($request);

            if ($userForm->isValid()) {

                $user = $userForm->getData();
				//KODOWANIE HASLA:
				$factory = $this->get('security.encoder_factory');
				$encoder = $factory->getEncoder($user);
				$password = $encoder->encodePassword($user->getPassword(), $user->getSalt());
				$user->setPassword($password);
				//KODOWANIE HASLA:
				$em = $this->getDoctrine()->getManager();

					$em->persist($user);
					$em->flush();
					$user_id = $user->getUserId();
				
				        $request->getSession()->getFlashBag()->add(
            'notice',
            'User registered!'
        );
		
		$current_user = $this->getDoctrine()
        ->getRepository('ProjectPortalBundle:User')
        ->find($user_id);

        return $this->render('ProjectPortalBundle:User:view.html.twig', array('user' => $current_user ));

            }

        }
		
		return $this->render('ProjectPortalBundle:User:add.html.twig', array('form' => $userForm->createView()));
    }

	public function view_postsAction($user_id)
    {
		
			 /**
     * @Route("/user/{user_id}/posts")
	     */

	    $current_user = $this->getDoctrine()
        ->getRepository('ProjectPortalBundle:User')
        ->find($user_id);

    if (!$current_user) {
        throw $this->createNotFoundException(
            'No user found for id in the database '.$user_id
        );
    }
	
				$repository = $this->getDoctrine()
		->getRepository('ProjectPortalBundle:Post');
		$posts = $repository->findBy(array('userUser' => $user_id));
		
		//$criteria = array('User_user_id' => $user_id);
		//$posts = $em->getRepository('ProjectPortalBundle:Post')->findBy($criteria);
		

		return $this->render('ProjectPortalBundle:User:view_posts.html.twig', array('posts' => $posts, 'user' => $current_user));

	
        //return $this->render('ProjectPortalBundle:User:view.html.twig', array('user' => $current_user ));
    }	

}