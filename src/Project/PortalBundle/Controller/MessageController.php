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
use Project\PortalBundle\Entity\Message;

/**
 * Message controller
 *
 * @package     ProjectPortalBundle
 * @author        Adrian Kuciel <kontakt@adriankuciel.pl>
 * @link            http://wierzba.wzks.uj.edu.pl/~10_kuciel/ztp/web
 */
 
class MessageController extends Controller
{
	    /**
     * Adds message
     *
     * @param integer $user_id      id
     * @param Request $request request
     *
     * @return void
     */
	public function addAction(Request $request, $user_id)
    {

        $message = new Message();
		$messageForm = $this->createForm(new Type\MessageType(), $message);

		
			$to_user = $this->getDoctrine()
			->getRepository('ProjectPortalBundle:User')
			->findOneByUserId($user_id);
			
		if (!$to_user){
			throw $this->createNotFoundException('User does not exist');
		}
				
        if ($request->isMethod('post')) {


            $messageForm->bindRequest($request);

            if ($messageForm->isValid()) {

                $message = $messageForm->getData();
				
				
				$em = $this->getDoctrine()->getManager();
		
					$from_user = $this->getUser();

					$message->setIdFrom($from_user->getUserId());
					$message->setUserUser($from_user);
					$message->setIdTo($to_user->getUserId());
					$em->merge($message);
					$em->flush();
					

				

				
				        $request->getSession()->getFlashBag()->add(
            'notice',
            'Your message was sent!'
        );
				
		$current_user = $this->getUser();
		$current_user_id = $current_user->getUserId();
		$messages = $this->getDoctrine()
		->getRepository('ProjectPortalBundle:Message')
		->findByIdTo($current_user_id);
		

		return $this->render('ProjectPortalBundle:Message:index.html.twig', array('messages' => $messages ));

            }

        }
		
        return $this->render('ProjectPortalBundle:Message:add.html.twig', array('form' => $messageForm->createView(), 'user_id' => $user_id, 'to_user' => $to_user));


	}
		    /**
     * Shows messages
     *
     * @return void
     */
	 
		public function indexAction()
    {
		$current_user = $this->getUser();
		$current_user_id = $current_user->getUserId();
		$messages = $this->getDoctrine()
		->getRepository('ProjectPortalBundle:Message')
		->findByIdTo($current_user_id);
		

		return $this->render('ProjectPortalBundle:Message:index.html.twig', array('messages' => $messages ));
    }
	
		    /**
     * Shows message
     *
     * @param integer $message_id      id
     *
     * @return void
     */
		public function viewAction($message_id)
    {
		

	    $message = $this->getDoctrine()
        ->getRepository('ProjectPortalBundle:Message')
        ->find($message_id);

		$user_from = $this->getDoctrine()
		->getRepository('ProjectPortalBundle:User')
		->findOneByUserId($message->getIdFrom());
			
		

    if (!$message) {
        throw $this->createNotFoundException(
            'This message doesnt exist! '.$message_id
        );
    }

        return $this->render('ProjectPortalBundle:Message:view.html.twig', array('message' => $message, 'user_from' => $user_from));
    }
}