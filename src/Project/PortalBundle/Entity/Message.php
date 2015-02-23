<?php

namespace Project\PortalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Message
 *
 * @ORM\Table(name="Message", uniqueConstraints={@ORM\UniqueConstraint(
 name="id_from_UNIQUE", columns={"id_from"}), @ORM\UniqueConstraint(name="id_to_UNIQUE", columns={"id_to"})},
 indexes={@ORM\Index(name="fk_Message_User_idx", columns={"User_user_id"})})
 * @ORM\Entity
 * @package     ProjectPortalBundle
 * @author        Adrian Kuciel <kontakt@adriankuciel.pl>
 * @link            http://wierzba.wzks.uj.edu.pl/~10_kuciel/ztp/web
 */
class Message
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_from", type="integer", nullable=false)
     */
    private $idFrom;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_to", type="integer", nullable=false)
     */
    private $idTo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="message_time", type="datetime", nullable=false)
     */
    private $messageTime;

    /**
     * @var string
     *
     * @ORM\Column(name="msg_body", type="text", nullable=false)
     */
    private $msgBody;

    /**
     * @var integer
     *
     * @ORM\Column(name="message_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $messageId;

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
        $this->setMessageTime(new \DateTime());

    }

    /**
     * Set idFrom
     *
     * @param integer $idFrom
     * @return Message
     */
    public function setIdFrom($idFrom)
    {
        $this->idFrom = $idFrom;

        return $this;
    }

    /**
     * Get idFrom
     *
     * @return integer
     */
    public function getIdFrom()
    {
        return $this->idFrom;
    }

    /**
     * Set idTo
     *
     * @param integer $idTo
     * @return Message
     */
    public function setIdTo($idTo)
    {
        $this->idTo = $idTo;

        return $this;
    }

    /**
     * Get idTo
     *
     * @return integer
     */
    public function getIdTo()
    {
        return $this->idTo;
    }

    /**
     * Set messageTime
     *
     * @param \DateTime $messageTime
     * @return Message
     */
    public function setMessageTime($messageTime)
    {
        $this->messageTime = $messageTime;

        return $this;
    }

    /**
     * Get messageTime
     *
     * @return \DateTime
     */
    public function getMessageTime()
    {
        return $this->messageTime;
    }

    /**
     * Set msgBody
     *
     * @param string $msgBody
     * @return Message
     */
    public function setMsgBody($msgBody)
    {
        $this->msgBody = $msgBody;

        return $this;
    }

    /**
     * Get msgBody
     *
     * @return string
     */
    public function getMsgBody()
    {
        return $this->msgBody;
    }

    /**
     * Get messageId
     *
     * @return integer
     */
    public function getMessageId()
    {
        return $this->messageId;
    }

    /**
     * Set userUser
     *
     * @param \Project\PortalBundle\Entity\User $userUser
     * @return Message
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
