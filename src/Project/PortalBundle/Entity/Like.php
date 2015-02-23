<?php

namespace Project\PortalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Like
 *
 * @ORM\Table(name="Likes", indexes={@ORM\Index(name="fk_Like_Post1_idx",
 columns={"Post_post_id"}), @ORM\Index(name="fk_Like_User1_idx", columns={"User_user_id"})})
 * @ORM\Entity
 * @package     ProjectPortalBundle
 * @author        Adrian Kuciel <kontakt@adriankuciel.pl>
 * @link            http://wierzba.wzks.uj.edu.pl/~10_kuciel/ztp/web
 */
class Like
{
    /**
     * @var integer
     *
     * @ORM\Column(name="like_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $likeId;

    /**
     * @var \Project\PortalBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="Project\PortalBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="User_user_id", referencedColumnName="user_id")
     * })
     */
    private $userUser;

    /**
     * @var \Project\PortalBundle\Entity\Post
     *
     * @ORM\ManyToOne(targetEntity="Project\PortalBundle\Entity\Post")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Post_post_id", referencedColumnName="post_id")
     * })
     */
    private $postPost;

    /**
     * Get likeId
     *
     * @return integer
     */
    public function getLikeId()
    {
        return $this->likeId;
    }

    /**
     * Set userUser
     *
     * @param \Project\PortalBundle\Entity\User $userUser
     * @return Like
     */
    public function setUserUser(\Project\PortalBundle\Entity\User $userUser = null)
    {
        $this->userUser = $userUser;

        return $this;
    }

    /**
     * Get userUser
     *
     * @return \Project\PortalBundle\Entity\User
     */
    public function getUserUser()
    {
        return $this->userUser;
    }

    /**
     * Set postPost
     *
     * @param \Project\PortalBundle\Entity\Post $postPost
     * @return Like
     */
    public function setPostPost(\Project\PortalBundle\Entity\Post $postPost = null)
    {
        $this->postPost = $postPost;

        return $this;
    }

    /**
     * Get postPost
     *
     * @return \Project\PortalBundle\Entity\Post
     */
    public function getPostPost()
    {
        return $this->postPost;
    }
}
