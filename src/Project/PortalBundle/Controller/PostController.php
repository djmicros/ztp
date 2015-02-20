<?php
namespace Project\PortalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Project\PortalBundle\Form\Type;
use Project\PortalBundle\Entity\Post;
use Project\PortalBundle\Entity\Tag;
use Project\PortalBundle\Entity\PostTags;

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
		//$tag = new Tag();
		//$tagForm = $this->createForm(new Type\TagType(), $tag);


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
					
				if ($post->getTag() != null) {
						$tag = new Tag();
						$tag = $post->getTag();
						$tag_name = $tag->getTagName();
						
						
					$existing_tag = $this->getDoctrine()
					->getRepository('ProjectPortalBundle:Tag')
					->findOneByTagName($tag_name);
					
					if ($existing_tag == null) {
						$em = $this->getDoctrine()->getManager();
						//$em->merge($tag);
						$em->persist($tag);
						$em->flush();
						$existing_tag = $tag;
					}
						$post_tag = new PostTags();
						$post_tag->setTagTag($existing_tag);
						$post_tag->setPostPost($post);
						$em = $this->getDoctrine()->getManager();
						//$em->merge($post_tag);
						$em->persist($post_tag);
						$em->flush();
						
					
					
				}

				

				
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
	
		public function editAction(Request $request, $post_id)
    {
		$em = $this->getDoctrine()->getEntityManager();
		$post = $em->getRepository('ProjectPortalBundle:Post')
        ->find($post_id);

    if (!$post) {
        throw $this->createNotFoundException(
            'No post found for id in the database '.$post_id
        );
    }
	
		$post_tag = $this->getDoctrine()
        ->getRepository('ProjectPortalBundle:PostTags')
        ->findOneBy(array('postPost' => $post_id));
		$tag = $post_tag->getTagTag();
		$post->setTag($tag);
        $postForm = $this->createForm(new Type\EditPostType(), $post);
		$old_tag = $tag;

				
        if ($request->isMethod('post')) {


            $postForm->bindRequest($request);

            if ($postForm->isValid()) {

                $post = $postForm->getData();

						$tag_name = $tag->getTagName();
						
						
					$existing_tag = $this->getDoctrine()
					->getRepository('ProjectPortalBundle:Tag')
					->findOneByTagName($tag_name);
					
					if (!$existing_tag) {
						$new_tag = new Tag();
						$new_tag->setTagName($tag_name);
						$em->flush();
					}
					
					if ($existing_tag != $old_tag){
						$post_tag = new PostTags();
						$post_tag->setTagTag($new_tag);
						$post_tag->setPostPost($post);
						$em->flush();
					}

					
					$em->persist($post);	
					$em->flush();
			

				
				        $request->getSession()->getFlashBag()->add(
            'notice',
            'Your post was updated!'
        );
				
		$repository = $this->getDoctrine()
		->getRepository('ProjectPortalBundle:Post');
		
		$posts = $repository->findAll();

		return $this->render('ProjectPortalBundle:Post:index.html.twig', array('posts' => $posts ));

            }

        }

        return $this->render('ProjectPortalBundle:Post:edit.html.twig', array('form' => $postForm->createView(), 'post_id' => $post_id));
    }
}