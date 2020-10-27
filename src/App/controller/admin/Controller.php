<?php


namespace App\controller\admin;


use AltoRouter;
use App\Connection;

class Controller
{

    protected $router;
    protected $pdo;
    protected $id;
    protected $status;
    protected $slug;

    public function __construct(AltoRouter $router, ?array $params = [])
    {
        $this->router = $router;
        $this->pdo = Connection::get_pdo();

        if (isset($params['id'])) { $this->id = (int)$params['id']; }
        if (isset($params['slug'])) { $this->slug = $params['slug']; }
        if (isset($params['status'])) { $this->status = $params['status']; }

    }

}