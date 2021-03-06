<?php


namespace App;


class PaginatedQuery
{

    private $manager;


    /**
     * @param $manager
     */
    public function __construct($manager)
    {
        $this->manager = $manager;

    }

    /**
     * @return array [items, NbPages]
     * @throws \Exception
     */
    public function getPaginatedItems()
    {
        $countPost = $this->manager->count();
        $currentPage = URL::getPositiveInt('page', 1);
        $perPage = 12;
        $pages = ceil($countPost / $perPage);
        if ($currentPage > $pages)
        {
            throw new Exception('Cette page n\'existe pas');
        }
        $offset = $perPage * ($currentPage - 1);

        return array(
            'items' => $this->manager->getList($perPage, $offset),
            'pages' => $pages
            ) ;

    }

}