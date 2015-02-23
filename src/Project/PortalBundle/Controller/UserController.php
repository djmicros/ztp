<?php
namespace Project\PortalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Project\PortalBundle\Form\Type;
use Project\PortalBundle\Entity\User;
use Project\PortalBundle\Entity\Friendship;

/**
 * User controller
 *
 * @package     ProjectPortalBundle
 * @author        Adrian Kuciel <kontakt@adriankuciel.pl>
 * @link            http://wierzba.wzks.uj.edu.pl/~10_kuciel/ztp/web
 */
 
class UserController extends Controller
{
        /**
     * Shows user
     *
     * @param integer $user_id      id
     *
     * @return void
     */


    public function viewAction($user_id)
    {

        $current_user = $this->getDoctrine()
        ->getRepository('ProjectPortalBundle:User')
        ->find($user_id);

        if (!$current_user) {
            throw $this->createNotFoundException(
                'No user found for id in the database '.$user_id
            );
        }
    
        $logged_user = $this->getUser();
        $em = $this->getDoctrine()->getEntityManager();
        $friendship = $em->getRepository('ProjectPortalBundle:Friendship')
        ->findOneBy(array('friend2' => $user_id, 'userUser' => $logged_user));
        
        if (!$friendship) {
            $friendship = 0;
        } else {
            $friendship = 1;
        }
        
        return $this->render('ProjectPortalBundle:User:view.html.twig', array(
        'user' => $current_user, 'friendship' => $friendship ));
    }
            /**
     * Adds user
     *
     * @param Request $request request
     *
     * @return void
     */

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

                        return $this->render('ProjectPortalBundle:User:view.html.twig', array(
                        'user' => $current_user ));

            }

        }
        
        return $this->render('ProjectPortalBundle:User:add.html.twig', array('form' => $userForm->createView()));
        }

            /**
     * Shows user
     *
     * @param integer $user_id      id
     *
     * @return void
     */
     
        public function view_postsAction($user_id)
        {
        

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
        
        

            return $this->render('ProjectPortalBundle:User:view_posts.html.twig', array(
            'posts' => $posts, 'user' => $current_user));

    
        }
        /**
     * Shows users
     *
     * @return void
     */
        public function indexAction()
        {

            $repository = $this->getDoctrine()
            ->getRepository('ProjectPortalBundle:User');
        
            $users = $repository->findAll();

            return $this->render('ProjectPortalBundle:User:index.html.twig', array('users' => $users ));
        }
}
