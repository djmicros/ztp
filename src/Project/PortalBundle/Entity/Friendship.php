<?php

namespace Project\PortalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Friendship
 *
 * @ORM\Table(name="Friendship", uniqueConstraints={@ORM\UniqueConstraint(name="friend_2_UNIQUE", columns={"friend_2"}), @ORM\UniqueConstraint(name="friend_1_UNIQUE", columns={"friend_1"})}, indexes={@ORM\Index(name="fk_Friendship_User1_idx", columns={"User_user_id"})})
 * @ORM\Entity
 * @package     ProjectPortalBundle
 * @author        Adrian Kuciel <kontakt@adriankuciel.pl>
 * @link            http://wierzba.wzks.uj.edu.pl/~10_kuciel/ztp/web
 */
class Friendship
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="friendship_date", type="datetime", nullable=false)
     */
    private $friendshipDate;

    /**
     * @var integer
     *
     * @ORM\Column(name="friend_1", type="integer", nullable=false)
     */
    private $friend1;

    /**
     * @var integer
     *
     * @ORM\Column(name="friend_2", type="integer", nullable=false)
     */
    private $friend2;

    /**
     * @var integer
     *
     * @ORM\Column(name="friendship_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $friendshipId;

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
        $this->setFriendshipDate(new \DateTime());

    }

    /**
     * Set friendshipDate
     *
     * @param \DateTime $friendshipDate
     * @return Friendship
     */
    public function setFriendshipDate($friendshipDate)
    {
        $this->friendshipDate = $friendshipDate;

        return $this;
    }

    /**
     * Get friendshipDate
     *
     * @return \DateTime 
     */
    public function getFriendshipDate()
    {
        return $this->friendshipDate;
    }

    /**
     * Set friend1
     *
     * @param integer $friend1
     * @return Friendship
     */
    public function setFriend1($friend1)
    {
        $this->friend1 = $friend1;

        return $this;
    }

    /**
     * Get friend1
     *
     * @return integer 
     */
    public function getFriend1()
    {
        return $this->friend1;
    }

    /**
     * Set friend2
     *
     * @param integer $friend2
     * @return Friendship
     */
    public function setFriend2($friend2)
    {
        $this->friend2 = $friend2;

        return $this;
    }

    /**
     * Get friend2
     *
     * @return integer 
     */
    public function getFriend2()
    {
        return $this->friend2;
    }

    /**
     * Get friendshipId
     *
     * @return integer 
     */
    public function getFriendshipId()
    {
        return $this->friendshipId;
    }

    /**
     * Set userUser
     *
     * @param \Project\PortalBundle\Entity\User $userUser
     * @return Friendship
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
