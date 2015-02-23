<?php

namespace Project\PortalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tag
 *
 * @ORM\Table(name="Tag", uniqueConstraints={@ORM\UniqueConstraint(name="tag_name_UNIQUE", columns={"tag_name"})})
 * @ORM\Entity
 * @package     ProjectPortalBundle
 * @author        Adrian Kuciel <kontakt@adriankuciel.pl>
 * @link            http://wierzba.wzks.uj.edu.pl/~10_kuciel/ztp/web
 */
class Tag
{
    /**
     * @var string
     *
     * @ORM\Column(name="tag_name", type="string", length=45, nullable=true)
     */
    private $tagName;

    /**
     * @var integer
     *
     * @ORM\Column(name="tag_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $tagId;
	



    /**
     * Set tagName
     *
     * @param string $tagName
     * @return Tag
     */
    public function setTagName($tagName)
    {
        $this->tagName = $tagName;

        return $this;
    }

    /**
     * Get tagName
     *
     * @return string 
     */
    public function getTagName()
    {
        return $this->tagName;
    }

    /**
     * Get tagId
     *
     * @return integer 
     */
    public function getTagId()
    {
        return $this->tagId;
    }
}
