<?php

require_once "html_doc.php";

class BasicDoc extends HtmlDoc {
    
    protected $model;

    public function __construct($model) {
        $this->model = $model;
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
        foreach ($this->model->menu as $menuItem) {
            $menuItem->showHtmlMenuItem();
        }
        echo '</ul></div>';
    }

    protected function showContent() {
        echo '<p>Basic</p>';
    }

    protected function showGenericErr() {
        echo '<div class="error">'. $this->model->genericErr .'</div>';
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