<?php


namespace App\Model\Entity;


use DateTime;

/**
 * Class Comment
 * @package App\Model\Entity
 */
class Comment
{
    /**
     * @var
     */
    private $_id;
    /**
     * @var
     */
    private $_authorName;
    /**
     * @var
     */
    private $_authorEmail;
    /**
     * @var
     */
    private $_content;
    /**
     * @var
     */
    private $_createDate;
    /**
     * @var
     */
    private $_status;
    /**
     * @var
     */
    private $_postId;

    /**
     * Comment constructor.
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
        if (isset($donnees['comment_author_name'])){ $this->setAuthorName($donnees['comment_author_name']); }
        if (isset($donnees['comment_author_email'])){ $this->setAuthorEmail($donnees['comment_author_email']); }
        if (isset($donnees['comment_content'])){ $this->setContent($donnees['comment_content']); }
        if (isset($donnees['comment_create'])){ $this->setCreateDate($donnees['comment_create']); }
        if (isset($donnees['comment_status'])){ $this->setStatus($donnees['comment_status']); }
        if (isset($donnees['post_id'])){ $this->setPostId($donnees['post_id']); }
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * @param int $id
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
     * @return DateTime
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
     * @param int $postId
     * @return Comment
     */
    public function setPostId($postId)
    {
        $this->_postId = $postId;
        return $this;
    }

}