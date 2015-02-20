<?php
namespace Project\PortalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Project\PortalBundle\Entity\Tag;
use Project\PortalBundle\Entity\Post;
use Project\PortalBundle\Entity\Post_Tags;

class TagController extends Controller
{

	/**
     * @Route("/tag/{tag_name}")
		*/     


	public function viewAction($tag_name)
    {
		$current_tag = new Tag();
	    $current_tag = $this->getDoctrine()
        ->getRepository('ProjectPortalBundle:Tag')
        ->findOneBy(array('tagName' => $tag_name));
		

    if (!$current_tag) {
        throw $this->createNotFoundException(
            'No such tag '.$tag_name
        );
    }
	
		$current_tag_id = $current_tag->getTagId();
		
		$post_tags = $this->getDoctrine()
        ->getRepository('ProjectPortalBundle:PostTags')
        ->findBy(array('tagTag' => $current_tag_id));
		
		$post_ids_array = array();
		foreach ($post_tags as $post_tag) {
			$post_object = $post_tag->getPostPost();
			$post_object_id = $post_object->getPostId();
			array_push($post_ids_array, $post_object_id);
		}
		
		$posts = $this->getDoctrine()
        ->getRepository('ProjectPortalBundle:Post')
        ->findBy(array('postId' => $post_ids_array));

        return $this->render('ProjectPortalBundle:Tag:view.html.twig', array('posts' => $posts, 'tag' => $current_tag ));
    }

	   

}