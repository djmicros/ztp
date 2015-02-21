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
use Project\PortalBundle\Entity\Like;

class LikeController extends Controller
{

	public function addAction(Request $request, $post_id)
    {

        $like = new Like();

		
			$current_post = $this->getDoctrine()
			->getRepository('ProjectPortalBundle:Post')
			->findOneByPostId($post_id);
			
		if (!$current_post){
			throw $this->createNotFoundException('The post does not exist');
		}
				
				$em = $this->getDoctrine()->getManager();
		
					$current_user = $this->getUser();

					$like->setUserUser($current_user);
					$like->setPostPost($current_post);
					
					$em->persist($like);
					$em->flush();

				

				
				        $request->getSession()->getFlashBag()->add(
            'notice',
            'Your like was saved!'
        );
				
		$repository = $this->getDoctrine()
		->getRepository('ProjectPortalBundle:Post');
		
		$posts = $repository->findAll();

		return $this->render('ProjectPortalBundle:Post:index.html.twig', array('posts' => $posts ));

            }





		public function editAction(Request $request, $comment_id)
    {
		$em = $this->getDoctrine()->getEntityManager();
		$comment = $em->getRepository('ProjectPortalBundle:Comment')
        ->find($comment_id);

    if (!$comment) {
        throw $this->createNotFoundException(
            'No comment found for id in the database '.$comment_id);
	}
	
	$current_user = $this->getUser();
	if ($current_user == $comment->getUserUser()){
	
	
        $commentForm = $this->createForm(new Type\CommentType(), $comment);

				
        if ($request->isMethod('post')) {


            $commentForm->bindRequest($request);

            if ($commentForm->isValid()) {

                $comment = $commentForm->getData();
						$em->flush();
					}
				
				        $request->getSession()->getFlashBag()->add(
            'notice',
            'Your comment was updated!'
        );
				
		$repository = $this->getDoctrine()
		->getRepository('ProjectPortalBundle:Post');
		
		$posts = $repository->findAll();

		return $this->render('ProjectPortalBundle:Post:index.html.twig', array('posts' => $posts ));

            }



        return $this->render('ProjectPortalBundle:Comment:edit.html.twig', array('form' => $commentForm->createView(), 'comment_id' => $comment_id));
	}
	else {
		        throw new AccessDeniedException(
            'You are not the author of this comment: '.$comment_id
        );
	}
    }

		public function deleteAction(Request $request, $comment_id)
    {
		$em = $this->getDoctrine()->getEntityManager();
		$comment = $em->getRepository('ProjectPortalBundle:Comment')
        ->find($comment_id);

    if (!$comment) {
        throw $this->createNotFoundException(
            'No comment found for id in the database '.$comment_id);
	}
	
	$current_user = $this->getUser();
	if ($current_user == $comment->getUserUser()){
		
		if ($request->isMethod('post')) {
			
		$em = $this->getDoctrine()->getEntityManager();
		$em->remove($comment);
		$em->flush();
		
		$request->getSession()->getFlashBag()->add(
            'notice',
            'Comment deleted!'
        );
		
		$repository = $this->getDoctrine()
		->getRepository('ProjectPortalBundle:Post');
		
		$posts = $repository->findAll();

		return $this->render('ProjectPortalBundle:Post:index.html.twig', array('posts' => $posts ));

		}

        return $this->render('ProjectPortalBundle:Comment:delete.html.twig', array('comment' => $comment, 'comment_id' => $comment_id ));
	}
		else {
		        throw new AccessDeniedException(
            'You are not the author of this comment: '.$comment_id
        );
	}
    }

}