<?php


namespace App\Model\Entity;


/**
 * Class Category
 * @package App\Model\Entity
 */
class Category
{
    /**
     * @var
     */
    private $_id;
    /**
     * @var
     */
    private $_title;
    /**
     * @var
     */
    private $_slug;

    /**
     * Category constructor.
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
        if (isset($donnees['category_title'])){ $this->setTitle($donnees['category_title']); }
        if (isset($donnees['category_slug'])){ $this->setSlug($donnees['category_slug']); }
    }


    /**
     * @return ?string
     */
    public function getTitle()
    {
        return $this->_title;
    }

    /**
     * @param mixed $title
     * @return Category
     */
    public function setTitle($title)
    {
        $this->_title = $title;
        return $this;
    }

    /**
     * @return ?string
     */
    public function getSlug()
    {
        return $this->_slug;
    }

    /**
     * @param mixed $slug
     * @return Category
     */
    public function setSlug($slug)
    {
        $this->_slug = $slug;
        return $this;
    }

    /**
     * @return ?int
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * @param mixed $id
     * @return Category
     */
    public function setId($id)
    {
        $this->_id = $id;
        return $this;
    }

}