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
use Project\PortalBundle\Entity\Friendship;

class FriendshipController extends Controller
{

	public function addAction(Request $request, $user_id)
    {

        $friendship = new Friendship();

			$current_user = $this->getUser();
			
			$second_user = $this->getDoctrine()
			->getRepository('ProjectPortalBundle:User')
			->findOneByUserId($user_id);
			
			
		if (!$second_user){
			throw $this->createNotFoundException('User does not exist');
		}
		
		if ($current_user == $second_user){
			throw $this->createNotFoundException('You cannot be friend with yourself!');
		}
				
				$em = $this->getDoctrine()->getManager();
		
					$friendship->setUserUser($current_user);
					$friendship->setFriend1($current_user->getUserId());
					$friendship->setFriend2($second_user->getUserId());
					
					$em->persist($friendship);
					$em->flush();

				

				
				        $request->getSession()->getFlashBag()->add(
            'notice',
            'You got new friend!'
        );
				
return $this->redirect($this->generateUrl("project_portal_user",array('user_id' => $user_id)));

            }


		public function deleteAction(Request $request, $user_id)
    {
		$current_user = $this->getUser();
		$em = $this->getDoctrine()->getEntityManager();
		$friendship = $em->getRepository('ProjectPortalBundle:Friendship')
        ->findOneBy(array('friend2' => $user_id, 'userUser' => $current_user));

    if (!$friendship) {
        throw $this->createNotFoundException(
            'You are not friends');
			}
			
		$em = $this->getDoctrine()->getEntityManager();
		$em->remove($friendship);
		$em->flush();
		
		$request->getSession()->getFlashBag()->add(
            'notice',
            'You are no more friends!'
        );
		

		return $this->redirect($this->generateUrl("project_portal_user",array('user_id' => $user_id)));


    }

}