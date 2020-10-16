<?php


namespace App\Model\Entity;


use DateTime;

class Comment
{
    private $_id;
    private $_authorName;
    private $_authorEmail;
    private $_content;
    private $_createDate;
    private $_status;
    private $_postId;

    Public function __construct(array $donnees)
    {
        $this->hydrate($donnees);
    }

    public function hydrate(array $donnees)
    {
        if (isset($donnees['id'])){ $this->setId($donnees['id']); }
        if (isset($donnees['comment_author_name'])){ $this->setAuthorName($donnees['comment_author_name']); }
        if (isset($donnees['comment_author_email'])){ $this->setAuthorEmail($donnees['comment_author_email']); }
        if (isset($donnees['comment_content'])){ $this->setContent($donnees['comment_content']); }
        if (isset($donnees['comment_create'])){ $this->setCreateDate($donnees['comment_create']); }
        if (isset($donnees['comment_status'])){ $this->setStatus($donnees['comment_status']); }
        if (isset($donnees['post_id'])){ $this->setPostId($donnees['post_id']); }
    }


//    public function getCreateDate(): DateTime
//    {
//        return new DateTime($this->_createDate);
//    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * @param mixed $id
     * @return Comment
     */
    public function setId($id)
    {
        $this->_id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAuthorName()
    {
        return $this->_authorName;
    }

    /**
     * @param mixed $authorName
     * @return Comment
     */
    public function setAuthorName($authorName)
    {
        $this->_authorName = $authorName;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAuthorEmail()
    {
        return $this->_authorEmail;
    }

    /**
     * @param mixed $authorEmail
     * @return Comment
     */
    public function setAuthorEmail($authorEmail)
    {
        $this->_authorEmail = $authorEmail;
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
     * @return Comment
     */
    public function setContent($content)
    {
        $this->_content = $content;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCreateDate(): DateTime
    {
        return new DateTime($this->_createDate);
    }

    /**
     * @param mixed $createDate
     * @return Comment
     */
    public function setCreateDate($createDate)
    {
        $this->_createDate = $createDate;
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
     * @return Comment
     */
    public function setStatus($status)
    {
        $this->_status = $status;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPostId()
    {
        return $this->_postId;
    }

    /**
     * @param mixed $postId
     * @return Comment
     */
    public function setPostId($postId)
    {
        $this->_postId = $postId;
        return $this;
    }







}