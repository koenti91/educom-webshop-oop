<?php
require_once "basic_doc.php";

class OrderConfirmationDoc extends BasicDoc {
    
    protected function ShowHeader() {
        echo 'Bestelling bevestigd!';
    }

    protected function ShowContent() {
        echo '<p> Bedankt voor je bestelling!</p>';
    }
}

?>