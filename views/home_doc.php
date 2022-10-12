<?php
require_once "basic_doc.php";

class HomeDoc extends BasicDoc {
    
    // override
    protected function showHeader() {
        echo 'Home'; 
    }

    // override 
    protected function showContent() {
        echo '<p>
        Welkom op deze website! Ik ga het hier even lekker over mijzelf hebben.
        </p>';
    }
}

?>