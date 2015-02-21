<?php
namespace Project\PortalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Helper\DialogHelper;
use Symfony\Component\Console\Helper\HelperSet;
use Symfony\Component\Console\Tester\CommandTester;

use Project\PortalBundle\Form\Type;
use Project\PortalBundle\Entity\Post;
use Project\PortalBundle\Entity\Tag;
use Project\PortalBundle\Entity\PostTags;
use Project\PortalBundle\Entity\Comment;

class CommentController extends Controller
{

	public function addAction(Request $request, $post_id)
    {

        $comment = new Comment();
        $commentForm = $this->createForm(new Type\CommentType(), $comment);
		
			$current_post = $this->getDoctrine()
			->getRepository('ProjectPortalBundle:Post')
			->findOneByPostId($post_id);
			
		if (!$current_post){
			throw $this->createNotFoundException('The post does not exist');
		}



        if ($request->isMethod('post')) {


            $commentForm->bindRequest($request);

            if ($commentForm->isValid()) {

                $comment = $commentForm->getData();
				
				$em = $this->getDoctrine()->getManager();
		
					$current_user = $this->getUser();

					$comment->setUserUser($current_user);
					$comment->setPostPost($current_post);
					
					$em->persist($comment);
					$em->flush();

				

				
				        $request->getSession()->getFlashBag()->add(
            'notice',
            'Your comment was saved!'
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

        return $this->render('ProjectPortalBundle:Comment:add.html.twig', array('form' => $commentForm->createView(), 'post_id' => $post_id));
    }
	/**
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
	
	$current_user = $this->getUser();
	if ($current_user == $post->getUserUser()){
	
	
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
	else {
		        throw new AccessDeniedException(
            'You are not the author of this post: '.$post_id
        );
	}
    }
	
		public function deleteAction(Request $request, $post_id)
    {
		

	    $current_post = $this->getDoctrine()
        ->getRepository('ProjectPortalBundle:Post')
        ->find($post_id);

    if (!$current_post) {
        throw $this->createNotFoundException(
            'No post found for id in the database '.$post_id
        );
    }

		$current_user = $this->getUser();
	if ($current_user == $current_post->getUserUser()){
		
		if ($request->isMethod('post')) {
			
		$em = $this->getDoctrine()->getEntityManager();
		$em->remove($current_post);
		$em->flush();
		
		$request->getSession()->getFlashBag()->add(
            'notice',
            'Post deleted!'
        );
		
		$repository = $this->getDoctrine()
		->getRepository('ProjectPortalBundle:Post');
		
		$posts = $repository->findAll();

		return $this->render('ProjectPortalBundle:Post:index.html.twig', array('posts' => $posts ));

		}
	

	
	
	

        return $this->render('ProjectPortalBundle:Post:delete.html.twig', array('post' => $current_post, 'post_id' => $post_id ));
	}
		else {
		        throw new AccessDeniedException(
            'You are not the author of this post: '.$post_id
        );
	}
    }
	*/
}