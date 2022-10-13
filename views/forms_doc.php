<?php 
require_once "basic_doc.php";

class FormsDoc extends BasicDoc {

    private function showForm() {
        echo '<form method="post" action="index.php">';
        $this->showContent();
        echo '</form>';
    }
    
}
?>