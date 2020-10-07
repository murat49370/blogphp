<?php


namespace App\Entity;


class post
{
    private $id;
    private $createDate;
    private $modifiedDate;
    private $title;
    private $slug;
    private $shortContent;
    private $content;
    private $status;
    private $mainImage;
    private $smallImage;
    private $userId;

    /**
     * @return mixed
     */
    public function getCreateDate()
    {
        return $this->createDate;
    }

    /**
     * @param mixed $createDate
     * @return post
     */
    public function setCreateDate($createDate)
    {
        $this->createDate = $createDate;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getModifiedDate()
    {
        return $this->modifiedDate;
    }

    /**
     * @param mixed $modifiedDate
     * @return post
     */
    public function setModifiedDate($modifiedDate)
    {
        $this->modifiedDate = $modifiedDate;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     * @return post
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param mixed $slug
     * @return post
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getShortContent()
    {
        return $this->shortContent;
    }

    /**
     * @param mixed $shortContent
     * @return post
     */
    public function setShortContent($shortContent)
    {
        $this->shortContent = $shortContent;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     * @return post
     */
    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     * @return post
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMainImage()
    {
        return $this->mainImage;
    }

    /**
     * @param mixed $mainImage
     * @return post
     */
    public function setMainImage($mainImage)
    {
        $this->mainImage = $mainImage;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSmallImage()
    {
        return $this->smallImage;
    }

    /**
     * @param mixed $smallImage
     * @return post
     */
    public function setSmallImage($smallImage)
    {
        $this->smallImage = $smallImage;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param mixed $userId
     * @return post
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }





}