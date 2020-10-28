<?php


namespace App\Model\Entity;


use DateTime;

/**
 * Class Post
 * @package App\Model\Entity
 */
class Post
{
    /**
     * @var
     */
    private $_id;
    /**
     * @var
     */
    private $_createDate;
    /**
     * @var
     */
    private $_modifiedDate;
    /**
     * @var
     */
    private $_title;
    /**
     * @var
     */
    private $_slug;
    /**
     * @var
     */
    private $_shortContent;
    /**
     * @var
     */
    private $_content;
    /**
     * @var
     */
    private $_status;
    /**
     * @var
     */
    private $_mainImage;
    /**
     * @var
     */
    private $_smallImage;
    /**
     * @var
     */
    private $_userId;

    /**
     * Post constructor.
     * @param array $donnees
     */
    Public function __construct(array $donnees)
    {
        $this->hydrate($donnees);
    }

    /**
     * @param array $donnees
     */
    public function hydrate(array $donnees)
    {
        if (isset($donnees['id'])){ $this->setId($donnees['id']); }
        if (isset($donnees['post_create'])){ $this->setCreateDate($donnees['post_create']); }
        if (isset($donnees['post_modified'])){ $this->setModifiedDate($donnees['post_modified']); }
        if (isset($donnees['post_title'])){ $this->setTitle($donnees['post_title']); }
        if (isset($donnees['post_slug'])){ $this->setSlug($donnees['post_slug']); }
        if (isset($donnees['post_short_content'])){ $this->setShortContent($donnees['post_short_content']); }
        if (isset($donnees['post_content'])){ $this->setContent($donnees['post_content']); }
        if (isset($donnees['post_status'])){ $this->setStatus($donnees['post_status']); }
        if (isset($donnees['post_main_image'])){ $this->setMainImage($donnees['post_main_image']); }
        if (isset($donnees['post_small_image'])){ $this->setSmallImage($donnees['post_small_image']); }
        if (isset($donnees['user_id'])){ $this->setUserId($donnees['user_id']); }
    }


    /**
     * @return mixed
     *
     */
    public function getCreateDate(): DateTime
    {
        return new DateTime($this->_createDate, new \DateTimeZone('Europe/Paris'));
    }

    /**
     * @param mixed $createDate
     * @return post
     */
    public function setCreateDate($createDate)
    {
        $this->_createDate = $createDate;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getModifiedDate(): DateTime
    {
        return new DateTime($this->_modifiedDate);
    }

    /**
     * @param mixed $modifiedDate
     * @return post
     */
    public function setModifiedDate($modifiedDate)
    {
        $this->_modifiedDate = $modifiedDate;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->_title;
    }

    /**
     * @param mixed $title
     * @return post
     */
    public function setTitle($title)
    {
        $this->_title = $title;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSlug()
    {
        return $this->_slug;
    }

    /**
     * @param mixed $slug
     * @return post
     */
    public function setSlug($slug)
    {
        $this->_slug = $slug;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getShortContent()
    {
        return $this->_shortContent;
    }

    /**
     * @param mixed $shortContent
     * @return post
     */
    public function setShortContent($shortContent)
    {
        $this->_shortContent = $shortContent;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->_content;
    }

    /**
     * @param mixed $content
     * @return post
     */
    public function setContent($content)
    {
        $this->_content = $content;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->_status;
    }

    /**
     * @param mixed $status
     * @return post
     */
    public function setStatus($status)
    {
        $this->_status = $status;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMainImage()
    {
        return $this->_mainImage;
    }

    /**
     * @param mixed $mainImage
     * @return post
     */
    public function setMainImage($mainImage)
    {
        $this->_mainImage = $mainImage;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSmallImage()
    {
        return $this->_smallImage;
    }

    /**
     * @param mixed $smallImage
     * @return post
     */
    public function setSmallImage($smallImage)
    {
        $this->_smallImage = $smallImage;
        return $this;
    }

    /**
     * @return int
     */
    public function getUserId()
    {
        return $this->_userId;
    }

    /**
     * @param mixed $userId
     * @return post
     */
    public function setUserId($userId)
    {
        $this->_userId = $userId;
        return $this;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * @param int $id
     * @return post
     */
    public function setId($id)
    {
        $this->_id = $id;
        return $this;
    }

}