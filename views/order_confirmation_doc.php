<?php
require_once "basic_doc.php";

class OrderConfirmationDoc extends BasicDoc {
    
    protected function ShowHeaderContent() {
        echo 'Bestelling bevestigd!';
    }

    protected function ShowContent() {
        echo '<p> Bedankt voor je bestelling!</p>';
    }
}

?>