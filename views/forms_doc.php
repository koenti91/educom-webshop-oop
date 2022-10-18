<?php 
require_once "basic_doc.php";
require_once "constants.php";

abstract class FormsDoc extends BasicDoc {

    protected function showContent() {
        echo '<form method="post" action="index.php">';
        $this->showForm();
        echo '</form>';
    }
    protected abstract function showForm();
}
?>