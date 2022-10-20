<?php

class MenuItem {
    private $link;
    private $label;

    public function __construct($link, $label) {
        $this->link = $link;
        $this->label = $label;
    }

    public function showHtmlMenuItem() {
        echo '<li><a href="index.php?page='.$this->link.'">'.$this->label.'</a></li>';
    }
}

?>