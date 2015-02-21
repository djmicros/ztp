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

class MessageController extends Controller
{

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
				
		$repository = $this->getDoctrine()
		->getRepository('ProjectPortalBundle:Post');
		
		$posts = $repository->findAll();

		return $this->render('ProjectPortalBundle:Post:index.html.twig', array('posts' => $posts ));

            }

        }

        return $this->render('ProjectPortalBundle:Message:add.html.twig', array('form' => $messageForm->createView(), 'user_id' => $user_id));


	}
	
		public function indexAction()
    {
		$current_user = $this->getUser();
		$current_user_id = $current_user->getUserId();
		$messages = $this->getDoctrine()
		->getRepository('ProjectPortalBundle:Message')
		->findByIdTo($current_user_id);
		

		return $this->render('ProjectPortalBundle:Message:index.html.twig', array('messages' => $messages ));
    }
	
		public function viewAction($message_id)
    {
		

	    $message = $this->getDoctrine()
        ->getRepository('ProjectPortalBundle:Message')
        ->find($message_id);
			
		

    if (!$message) {
        throw $this->createNotFoundException(
            'This message doesnt exist! '.$message_id
        );
    }

        return $this->render('ProjectPortalBundle:Message:view.html.twig', array('message' => $message));
    }
}