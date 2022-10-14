<?php
require_once "change_pw_doc.php";

class ChangePwConfirmDoc extends ChangePwDoc {

    protected function showContent() {
        echo
        '<p> Je wachtwoord is gewijzigd.</p>';
    }
}

?>
