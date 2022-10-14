<?php 
require_once "basic_doc.php";
require_once "constants.php";

class FormsDoc extends BasicDoc {

    private function showForm() {
        echo '<form method="post" action="index.php">';
        $this->showContent();
        echo '</form>';
    }

}
?>