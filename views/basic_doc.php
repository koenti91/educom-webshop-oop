<?php

require_once "html_doc.php";
require_once "../products_service.php";
require_once "../session_manager.php";
require_once "../db_repository.php";
require_once "../user_service.php";
require_once "../get_var.php";

class BasicDoc extends HtmlDoc {
    
    protected $data;

    public function __construct($data) {
        $this->data = $data;
    }

    private function showBasicHeader() {
        echo '<header>';
        $this->showHeader();
        echo '</header>';
    }

    protected function showHeader() {
        echo 'Basic';
    }

    private function showMenu () {
        echo '<div class="menu"><ul class="nav-tabs">';
        foreach ($this->data['menu'] as $link => $label) {
            echo '<li><a href="index.php?page='.$link.'">'.$label.'</a></li>';
        }
        echo '</ul></div>';
    }

    protected function showContent() {
        echo '<p>Basic</p>';
    }

    protected function showGenericErr() {
        echo '<div class="error">'.(array_key_exists('genericErr', $this->data) ? $this->data['genericErr'] : '') .'</div>';
    }
    
    private function showFooter() {
        echo '<footer>';
        echo '<p class="copyright">Copyright &copy; 2022 Koen Tiepel</p>';
        echo '</footer>';
    }

    // override HomeDoc
    protected function showHeadContent() {
        echo '<title>';
        $this->showHeader();
        echo '</title>';
        echo '<link rel="stylesheet" href="css/stylesheet.css">';
    }
    
    // override HomeDoc
    protected function showBodyContent() {
        $this->showBasicHeader();
        $this->showMenu(); 
        $this->showGenericErr(); 
        $this->showContent(); 
        $this->showFooter(); 
    }
}  
?>