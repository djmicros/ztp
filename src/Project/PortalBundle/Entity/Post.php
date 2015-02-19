<?php

namespace Project\PortalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * Post
 *
 * @ORM\Table(name="Post", indexes={@ORM\Index(name="fk_Post_User1_idx", columns={"User_user_id"})})
 * @ORM\Entity
 */
class Post
{
    /**
     * @var string
     *
     * @ORM\Column(name="post_body", type="text", nullable=false)
     */
    private $postBody;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="post_date", type="datetime", nullable=false)
     */
    private $postDate;

    /**
     * @var integer
     *
     * @ORM\Column(name="post_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $postId;

    /**
     * @var \Project\PortalBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="Project\PortalBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="User_user_id", referencedColumnName="user_id")
     * })
     */
    private $userUser;


	    public function __construct()
    {
        $this->setPostDate(new \DateTime());

    }

    /**
     * Set postBody
     *
     * @param string $postBody
     * @return Post
     */
    public function setPostBody($postBody)
    {
        $this->postBody = $postBody;

        return $this;
    }

    /**
     * Get postBody
     *
     * @return string 
     */
    public function getPostBody()
    {
        return $this->postBody;
    }

    /**
     * Set postDate
     *
     * @param \DateTime $postDate
     * @return Post
     */
    public function setPostDate($postDate)
    {
        $this->postDate = $postDate;

        return $this;
    }

    /**
     * Get postDate
     *
     * @return \DateTime 
     */
    public function getPostDate()
    {
        return $this->postDate;
    }

    /**
     * Get postId
     *
     * @return integer 
     */
    public function getPostId()
    {
        return $this->postId;
    }

    /**
     * Set userUser
     *
     * @param \Project\PortalBundle\Entity\User $userUser
     * @return Post
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
}
