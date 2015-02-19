<?php
namespace Project\PortalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Project\PortalBundle\Form\Type;
use Project\PortalBundle\Entity\Post;

class PostController extends Controller
{

	/**
     * @Route("/")
	*/

	public function indexAction()
    {

		$repository = $this->getDoctrine()
		->getRepository('ProjectPortalBundle:Post');
		
		$posts = $repository->findAll();

		return $this->render('ProjectPortalBundle:Post:index.html.twig', array('posts' => $posts ));
    }
	     


	public function viewAction($post_id)
    {
		

	    $current_post = $this->getDoctrine()
        ->getRepository('ProjectPortalBundle:Post')
        ->find($post_id);

    if (!$current_post) {
        throw $this->createNotFoundException(
            'No post found for id in the database '.$post_id
        );
    }
	

        return $this->render('ProjectPortalBundle:Post:view.html.twig', array('post' => $current_post ));
    }
	
	    public function addAction(Request $request)
    {

        $post = new Post();
        $postForm = $this->createForm(new Type\PostType(), $post);

        if ($request->isMethod('post')) {

            $postForm->bindRequest($request);

            if ($postForm->isValid()) {

                $post = $postForm->getData();
				
				$em = $this->getDoctrine()->getManager();
		
					$user = $this->getUser();
					$user_id = $user->getUserId();
					$author_user = $this->getDoctrine()
					->getRepository('ProjectPortalBundle:User')
					->find($user_id);
					$post->setUserUser($author_user);

				
					$em->persist($post);
					$em->flush();

				
				        $request->getSession()->getFlashBag()->add(
            'notice',
            'Your post were saved!'
        );
				
		$repository = $this->getDoctrine()
		->getRepository('ProjectPortalBundle:Post');
		
		$posts = $repository->findAll();

		return $this->render('ProjectPortalBundle:Post:index.html.twig', array('posts' => $posts ));

	
				 /**
    if (!in_array($post_id, $posts)) {
        throw $this->createNotFoundException('The post does not exist');
    }
	
	$current_post = $posts[$post_id];
	*/

            }

        }

        return $this->render('ProjectPortalBundle:Post:add.html.twig', array('form' => $postForm->createView()));
    }
}