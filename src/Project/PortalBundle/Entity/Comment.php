<?php

namespace Project\PortalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Comment
 *
 * @ORM\Table(name="Comment", indexes={@ORM\Index(name="fk_Comment_User1_idx", columns={"User_user_id"}), @ORM\Index(name="fk_Comment_Post1_idx", columns={"Post_post_id"})})
 * @ORM\Entity
 */
class Comment
{
    /**
     * @var string
     *
     * @ORM\Column(name="comment_body", type="text", nullable=false)
     */
    private $commentBody;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="comment_date", type="datetime", nullable=false)
     */
    private $commentDate;

    /**
     * @var integer
     *
     * @ORM\Column(name="comment_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $commentId;

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
     * @var \Project\PortalBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="Project\PortalBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="User_user_id", referencedColumnName="user_id")
     * })
     */
    private $userUser;



    /**
     * Set commentBody
     *
     * @param string $commentBody
     * @return Comment
     */
    public function setCommentBody($commentBody)
    {
        $this->commentBody = $commentBody;

        return $this;
    }

    /**
     * Get commentBody
     *
     * @return string 
     */
    public function getCommentBody()
    {
        return $this->commentBody;
    }

    /**
     * Set commentDate
     *
     * @param \DateTime $commentDate
     * @return Comment
     */
    public function setCommentDate($commentDate)
    {
        $this->commentDate = $commentDate;

        return $this;
    }

    /**
     * Get commentDate
     *
     * @return \DateTime 
     */
    public function getCommentDate()
    {
        return $this->commentDate;
    }

    /**
     * Get commentId
     *
     * @return integer 
     */
    public function getCommentId()
    {
        return $this->commentId;
    }

    /**
     * Set postPost
     *
     * @param \Project\PortalBundle\Entity\Post $postPost
     * @return Comment
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

    /**
     * Set userUser
     *
     * @param \Project\PortalBundle\Entity\User $userUser
     * @return Comment
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
