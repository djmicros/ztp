<?php

namespace Project\PortalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PostTags
 *
 * @ORM\Table(name="Post_Tags", indexes={@ORM\Index(name="fk_Post_Tags_Tag1_idx", columns={"Tag_tag_id"},
 onDelete="SET NULL"), @ORM\Index(name="fk_Post_Tags_Post1_idx", columns={"Post_post_id"}, onDelete="SET NULL")})
 * @ORM\Entity
 * @package     ProjectPortalBundle
 * @author        Adrian Kuciel <kontakt@adriankuciel.pl>
 * @link            http://wierzba.wzks.uj.edu.pl/~10_kuciel/ztp/web
 */
class PostTags
{
    /**
     * @var integer
     *
     * @ORM\Column(name="post_tag_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $postTagId;

    /**
     * @var \Project\PortalBundle\Entity\Post
     *
     * @ORM\ManyToOne(targetEntity="Project\PortalBundle\Entity\Post", onDelete="CASCADE")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Post_post_id", referencedColumnName="post_id", onDelete="CASCADE")
     * })
     */
    private $postPost;

    /**
     * @var \Project\PortalBundle\Entity\Tag
     *
     * @ORM\ManyToOne(targetEntity="Project\PortalBundle\Entity\Tag", cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Tag_tag_id", referencedColumnName="tag_id",
     nullable=true, cascade={"all"}, onDelete="CASCADE")
     * })
     */
    private $tagTag;



    /**
     * Get postTagId
     *
     * @return integer
     */
    public function getPostTagId()
    {
        return $this->postTagId;
    }

    /**
     * Set postPost
     *
     * @param \Project\PortalBundle\Entity\Post $postPost
     * @return PostTags
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
     * Set tagTag
     *
     * @param \Project\PortalBundle\Entity\Tag $tagTag
     * @return PostTags
     */
    public function setTagTag(\Project\PortalBundle\Entity\Tag $tagTag = null)
    {
        $this->tagTag = $tagTag;

        return $this;
    }

    /**
     * Get tagTag
     *
     * @return \Project\PortalBundle\Entity\Tag
     */
    public function getTagTag()
    {
        return $this->tagTag;
    }
}
