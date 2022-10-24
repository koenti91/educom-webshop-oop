<?php

class MenuItem {
    private $link;
    private $label;
    private $username;

    public function __construct($link, $label, $username="") {
        $this->link = $link;
        $this->label = $label;
        $this->username = $username;
    }

    public function showHtmlMenuItem() {
        echo '<li><a href="index.php?page='.$this->link.'">'.$this->label. ' '. $this->username.'</a></li>';
    }
}

?>