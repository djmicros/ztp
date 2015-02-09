<?php
namespace Project\PortalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


class PostsController extends Controller
{

 /**
     * @Route("/")
     */

	public function indexAction()
    {
		$posts = array(
    0 => array(
        'title' => 'Suspendisse potenti',
        'createdAt' => '2014-10-23 10:00:00',
        'isActive' => 1,
        'content' => 'Nunc ornare a purus vitae auctor. Donec ac magna aliquam eros interdum mollis. Nam ornare enim ut sapien aliquet, et auctor enim ultrices. Donec ornare sagittis arcu nec hendrerit. Duis feugiat augue eget felis molestie tristique. Pellentesque vulputate velit lobortis congue volutpat. Curabitur eget consequat justo. Cras vitae auctor mauris. Integer eget tortor id lorem aliquet luctus ut sed orci. Donec non diam at nibh finibus tincidunt.',
    ),
    1 => array(
        'title' => 'Integer efficitur enim eros, in lacinia dui consequat id',
        'createdAt' => '2014-11-05 11:23:36',
        'isActive' => 1,
        'content' => 'Suspendisse dapibus fermentum diam, in porttitor turpis interdum in. Sed dignissim scelerisque sapien nec porttitor. Donec nibh augue, commodo a quam commodo, varius vestibulum lorem. Mauris varius a sapien eu consequat. Curabitur nec luctus dolor. Sed gravida eget lorem vitae luctus. Nam eros justo, gravida ut sollicitudin eget, eleifend et lorem. Cras placerat eleifend accumsan. Morbi vulputate semper leo, in fermentum neque varius id. Etiam ullamcorper augue sit amet diam iaculis, a porta arcu faucibus. Vivamus ultrices, erat non gravida eleifend, magna est convallis velit, vitae tempus justo urna quis purus. Phasellus lacinia elementum felis a mattis. Ut convallis rhoncus gravida.',   
    ),
    2 => array(
        'title' => 'Nam vel sagittis turpis',
        'createdAt' => '2014-11-07 12:13:11',
        'isActive' => 1,
        'content' => 'Cras sodales neque ipsum, et suscipit mauris luctus et. Morbi at nunc non turpis porttitor sodales. Aliquam nec enim pretium, tempor sapien rhoncus, sagittis ipsum. Nam venenatis, mauris a aliquet vehicula, nisi ipsum pulvinar purus, varius tincidunt nulla dui quis arcu. Pellentesque vehicula leo et sem hendrerit sagittis. Morbi sit amet dolor finibus, ullamcorper lorem eget, pulvinar leo.',
    ),
    3 => array(
        'title' => 'Quisque mollis imperdiet nisi',
        'createdAt' => '2014-11-27 14:23:00',
        'isActive' => 1,
        'content' => 'Donec vel fermentum lacus, eu bibendum tellus. Mauris non volutpat magna. Ut id justo in felis volutpat lacinia eget feugiat nulla. Etiam eleifend elit posuere mauris rutrum facilisis. Suspendisse potenti. In leo dui, volutpat sed justo id, molestie placerat libero. Donec id orci sit amet est condimentum lacinia eget ut mauris. In in nulla nibh. Nam dui nunc, dapibus condimentum rhoncus quis, laoreet sed dui. Curabitur mi risus, auctor eget mollis eget, auctor eget enim. Suspendisse eu nunc porttitor sem ornare luctus.',
    ),
    4 => array(
        'title' => 'Nam risus velit, finibus a pulvinar eu, dapibus in purus',
        'createdAt' => '2014-11-28 23:21:07',
        'isActive' => 1,
        'content' => 'Duis convallis ex sed posuere tempus. Aliquam eget mattis nulla. Integer enim dui, consequat eget tincidunt et, luctus sit amet est. Nulla ac purus vel libero venenatis pretium tempor non justo. Ut sit amet sagittis massa, ut dictum justo. Suspendisse imperdiet, arcu quis blandit vulputate, eros ex mollis massa, et convallis magna ante ut nisl. Integer tincidunt commodo porta. Morbi blandit lacus in justo laoreet tincidunt. In enim eros, volutpat a sem vitae, dictum eleifend turpis.',
    ),  
);

		return $this->render('ProjectPortalBundle:Posts:index.html.twig', array('posts' => $posts ));
    }
	
	 /**
     * @Route("/view/{post_id}")
     */

	public function viewAction($post_id)
    {
		$posts = array(
    0 => array(
        'title' => 'Suspendisse potenti',
        'createdAt' => '2014-10-23 10:00:00',
        'isActive' => 1,
        'content' => 'Nunc ornare a purus vitae auctor. Donec ac magna aliquam eros interdum mollis. Nam ornare enim ut sapien aliquet, et auctor enim ultrices. Donec ornare sagittis arcu nec hendrerit. Duis feugiat augue eget felis molestie tristique. Pellentesque vulputate velit lobortis congue volutpat. Curabitur eget consequat justo. Cras vitae auctor mauris. Integer eget tortor id lorem aliquet luctus ut sed orci. Donec non diam at nibh finibus tincidunt.',
    ),
    1 => array(
        'title' => 'Integer efficitur enim eros, in lacinia dui consequat id',
        'createdAt' => '2014-11-05 11:23:36',
        'isActive' => 1,
        'content' => 'Suspendisse dapibus fermentum diam, in porttitor turpis interdum in. Sed dignissim scelerisque sapien nec porttitor. Donec nibh augue, commodo a quam commodo, varius vestibulum lorem. Mauris varius a sapien eu consequat. Curabitur nec luctus dolor. Sed gravida eget lorem vitae luctus. Nam eros justo, gravida ut sollicitudin eget, eleifend et lorem. Cras placerat eleifend accumsan. Morbi vulputate semper leo, in fermentum neque varius id. Etiam ullamcorper augue sit amet diam iaculis, a porta arcu faucibus. Vivamus ultrices, erat non gravida eleifend, magna est convallis velit, vitae tempus justo urna quis purus. Phasellus lacinia elementum felis a mattis. Ut convallis rhoncus gravida.',   
    ),
    2 => array(
        'title' => 'Nam vel sagittis turpis',
        'createdAt' => '2014-11-07 12:13:11',
        'isActive' => 1,
        'content' => 'Cras sodales neque ipsum, et suscipit mauris luctus et. Morbi at nunc non turpis porttitor sodales. Aliquam nec enim pretium, tempor sapien rhoncus, sagittis ipsum. Nam venenatis, mauris a aliquet vehicula, nisi ipsum pulvinar purus, varius tincidunt nulla dui quis arcu. Pellentesque vehicula leo et sem hendrerit sagittis. Morbi sit amet dolor finibus, ullamcorper lorem eget, pulvinar leo.',
    ),
    3 => array(
        'title' => 'Quisque mollis imperdiet nisi',
        'createdAt' => '2014-11-27 14:23:00',
        'isActive' => 1,
        'content' => 'Donec vel fermentum lacus, eu bibendum tellus. Mauris non volutpat magna. Ut id justo in felis volutpat lacinia eget feugiat nulla. Etiam eleifend elit posuere mauris rutrum facilisis. Suspendisse potenti. In leo dui, volutpat sed justo id, molestie placerat libero. Donec id orci sit amet est condimentum lacinia eget ut mauris. In in nulla nibh. Nam dui nunc, dapibus condimentum rhoncus quis, laoreet sed dui. Curabitur mi risus, auctor eget mollis eget, auctor eget enim. Suspendisse eu nunc porttitor sem ornare luctus.',
    ),
    4 => array(
        'title' => 'Nam risus velit, finibus a pulvinar eu, dapibus in purus',
        'createdAt' => '2014-11-28 23:21:07',
        'isActive' => 1,
        'content' => 'Duis convallis ex sed posuere tempus. Aliquam eget mattis nulla. Integer enim dui, consequat eget tincidunt et, luctus sit amet est. Nulla ac purus vel libero venenatis pretium tempor non justo. Ut sit amet sagittis massa, ut dictum justo. Suspendisse imperdiet, arcu quis blandit vulputate, eros ex mollis massa, et convallis magna ante ut nisl. Integer tincidunt commodo porta. Morbi blandit lacus in justo laoreet tincidunt. In enim eros, volutpat a sem vitae, dictum eleifend turpis.',
    ),  
);

	
	
    if (!in_array($post_id, $posts)) {
        throw $this->createNotFoundException('The post does not exist');
    }
	
	$current_post = $posts[$post_id];
	
        return $this->render('ProjectPortalBundle:Posts:view.html.twig', array('post' => $current_post ));
    }
}