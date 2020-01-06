<?php

namespace application\lib;

class Pagination {
    
    private $max = 10;
    private $route;
    private $index = '';
    private $current_page;
    private $total;
    private $limit;

    public function __construct($route, $total, $limit = 10) {
        $this->route = $route;
        $this->total = $total;
        $this->limit = $limit;
        $this->amount = $this->amount();
        $this->setCurrentPage();
    }
   
    public function get() {
        $links = null;
        //$limits = $this->limits();
        $html = '<nav><ul class="pagination">';
        for ($page = 1; $page <= $this->amount; $page++) {
            if ($page == $this->current_page) {
                $links .= '<li class="page-item active"><span class="page-link">'.$page.'</span></li>';
            } else {
                $links .= $this->generateHtml($page);
            }
        }
        if (!is_null($links)) {
            if ($this->current_page >= 1) {
                $links = $this->generateHtml($this->current_page+1, 'Вперед').$links;
            }
            if ($this->current_page > 1) {
                $links .= $this->generateHtml($this->current_page-1, 'Назад');
            }
        }
        $html .= $links.' </ul></nav>';
        return $html;
    }

    private function generateHtml($page, $text = null) {
        if (!$text) {
            $text = $page;
        }
        return '<li class="page-item"><a class="page-link" href="/'.$this->route['controller'].'/'.$this->route['action'].'/'.$page.'">'.$text.'</a></li>';
    }


   private function getPage(){

            $arr=explode('/',trim($_SERVER['REQUEST_URI'], '/'));

            return array_pop($arr);

    }

    private function setCurrentPage() {
        if (!empty($this->getPage())) {
            $currentPage = $this->getPage();
        } else {
            $currentPage = 1;
        }
        $this->current_page = $currentPage;

            if ($this->current_page > $this->amount) {
                $this->current_page = $this->amount;
            }


    }

    private function amount() {
        return ceil($this->total / $this->limit);
    }
}