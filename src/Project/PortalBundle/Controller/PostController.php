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
use Project\PortalBundle\Entity\User;
use Project\PortalBundle\Entity\Comment;

/**
 * Post controller
 *
 * @package     ProjectPortalBundle
 * @author        Adrian Kuciel <kontakt@adriankuciel.pl>
 * @link            http://wierzba.wzks.uj.edu.pl/~10_kuciel/ztp/web
 */
 
class PostController extends Controller
{

        /**
     * Shows posts
     *
     * @return void
     */

    public function indexAction()
    {

        $repository = $this->getDoctrine()
        ->getRepository('ProjectPortalBundle:Post');
        
        $posts = $repository->findAll();
        
        $new_post = new Post();
        $new_postForm = $this->createForm(new Type\PostType(), $new_post);

        return $this->render('ProjectPortalBundle:Post:index.html.twig', array(
        'posts' => $posts, 'new_post_form' => $new_postForm->createView()));
    }
         
        /**
     * Shows post
     *
     * @param integer $post_id      id
     *
     * @return void
     */

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
    
        $comments = $this->getDoctrine()
        ->getRepository('ProjectPortalBundle:Comment')
        ->findBy(array('postPost' => $post_id));
        
        $likes = $this->getDoctrine()
        ->getRepository('ProjectPortalBundle:Like')
        ->findBy(array('postPost' => $post_id));
        
        
        $comment = new Comment();
        $commentForm = $this->createForm(new Type\CommentType(), $comment);
        
        $post_tag = $this->getDoctrine()
        ->getRepository('ProjectPortalBundle:PostTags')
        ->findOneBy(array('postPost' => $current_post));
        
        $tag_id = $post_tag->getTagTag()->getTagId();
        
        $tag = $this->getDoctrine()
        ->getRepository('ProjectPortalBundle:Tag')
        ->findOneByTagId($tag_id);

        return $this->render('ProjectPortalBundle:Post:view.html.twig', array(
        'post' => $current_post, 'comments' => $comments, 'likes' => $likes,
        'tag' => $tag, 'comment_form' => $commentForm->createView() ));
    }
    
            /**
     * Adds post
     *
     * @param Request $request request
     *
     * @return void
     */
     
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
                            'Your post was saved!'
                        );
        
                $repository = $this->getDoctrine()
                ->getRepository('ProjectPortalBundle:Post');
                $posts = $repository->findAll();
                $new_post = new Post();
                $new_postForm = $this->createForm(new Type\PostType(), $new_post);

                return $this->render('ProjectPortalBundle:Post:index.html.twig', array(
                'posts' => $posts, 'new_post_form' => $new_postForm->createView()));

            }

        }

        return $this->render('ProjectPortalBundle:Post:add.html.twig', array('form' => $postForm->createView()));
    }
            /**
     * Edits message
     *
     * @param integer $post_id      id
     * @param Request $request request
     *
     * @return void
     */
     
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
        if ($current_user == $post->getUserUser()) {
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
                    
                    if ($existing_tag != $old_tag) {
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

            return $this->render('ProjectPortalBundle:Post:edit.html.twig', array(
            'form' => $postForm->createView(), 'post_id' => $post_id));
        } else {
                throw new AccessDeniedException(
                    'You are not the author of this post: '.$post_id
                );
        }
        }
    
            /**
     * Deletes post
     *
     * @param integer $post_id      id
     * @param Request $request request
     *
     * @return void
     */
     
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
            if ($current_user == $current_post->getUserUser()) {
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

                return $this->render('ProjectPortalBundle:Post:delete.html.twig', array(
                'post' => $current_post, 'post_id' => $post_id ));
            } else {
                throw new AccessDeniedException(
                    'You are not the author of this post: '.$post_id
                );
            }
        }
}
