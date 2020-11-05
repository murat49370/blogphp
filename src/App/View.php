<?php


namespace App;


class View
{

    private $file;
    private $title;

    public function render($title, $page, $data = [])
    {
        $this->title = $title;

        $this->file = '../views/' . $page;

        $content  = $this->renderFile($this->file, $data);
        if (stripos($this->file, 'backend'))
        {
            $layouts = '../views/backend/layouts/default.php';
        }else{
            $layouts = '../views/frontend/layouts/default.php';
        }

        $view = $this->renderFile($layouts, [
            'title' => $this->title,
            'content' => $content
        ]);
        echo $view;
    }

    private function renderFile($file, $data)
    {
        if(file_exists($file)){
            extract($data);
            ob_start();
            require $file;
            return ob_get_clean();
        }
        require '../views/404.php';
    }
}