<?php

class Paginator {

    private $_conn;
    private $_limit;
    private $_page;
    private $_query;
    private $_total;

    public function __construct($conn, $query) {

        $this->_conn = $conn;
        $this->_query = $query;

        $rs = $this->_conn->query($this->_query);
        $this->_conn->set_charset("utf8");
        $this->_total = $rs->num_rows;
     
    }

    public function getData($limit = 10, $page = 0) {

        $query;
        $results=array();
        
        $this->_limit = $limit;
        $this->_page = $page;
        
        if ($this->_limit == 'all') {
            $query = $this->_query;
        } else {
            $query      = $this->_query . " LIMIT " . ( ( $this->_page - 1 ) * $this->_limit ) . ", $this->_limit";
        }
       
        $rs = $this->_conn->query($query);
      
        while ($row = $rs->fetch_assoc()) {
            
            $results[] = $row;
        }
        
        $result = new stdClass();
        $result->page = $this->_page;
        $result->limit = $this->_limit;
        $result->total = $this->_total;
        $result->data = $results;

        return $result;
    }

    public function createLinks($links, $list_class,$native_page='',$params='') {
        
        if ($this->_limit == 'all') {
            return '';
        }

        $last = ceil($this->_total / $this->_limit);

        $start = ( ( $this->_page - $links ) > 0 ) ? $this->_page - $links : 1;
        $end = ( ( $this->_page + $links ) < $last ) ? $this->_page + $links : $last;

        $html = '<ul class="' . $list_class . '">';

        $class = ( $this->_page == 1 ) ? "disabled" : "";
        $prev=($this->_page == 1)?"#":$native_page.'?limit=' . $this->_limit . '&page=' . ( $this->_page - 1 ) . $params;
        $html .= '<li><a class="' . $class . '" href="'.$prev.'">Anterior</a></li>';

        if ($start > 1) {
            $html .= '<li><a href="'.$native_page.'?limit=' . $this->_limit . '&page=1'.$params .'">1</a></li>';
            $html .= '<li class="disabled"><span>...</span></li>';
        }

        for ($i = $start; $i <= $end; $i++) {
            $class = ( $this->_page == $i ) ? "active" : "";
            $html .= '<li><a class="' . $class . '" href="'.$native_page.'?limit=' . $this->_limit . '&page=' . $i . $params .'">' . $i . '</a></li>';
        }

        if ($end < $last) {
            $html .= '<li class="disabled"><span>...</span></li>';
            $html .= '<li><a href="?limit=' . $this->_limit . '&page=' . $last . $params .'">' . $last . '</a></li>';
        }

        $class = ( $this->_page == $last ) ? "disabled" : "";
        $next =($this->_page == $last)?"#":$native_page.'?limit=' . $this->_limit . '&page=' . ( $this->_page + 1 ) . $params;
        $html .= '<li><a class="' . $class . '" href="'.$next.'">Siguiente</a></li>';

        $html .= '</ul>';

        return $html;
    }
}
