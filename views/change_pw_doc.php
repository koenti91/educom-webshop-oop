<?php
require_once "forms_doc.php";

class ChangePwDoc extends FormsDoc {
    
    protected function showHeader() {
        echo 'Wachtwoord veranderen';
    }

    protected function showForm() {
        echo
        '<fieldset>
        <label for="current-password"><b>Oud wachtwoord: </b></label>
        <input class="password" type="password" name="current-password" id="current-password" maxlength="50" required>
        <span class="error">* '. $this->model["oldPasswordErr"] .' </span>
        <br>
        <label for="new-password"><b>Nieuw wachtwoord: </b></label>
        <input class="password" type="password" name="new-password" id="new-password" maxlength="50" required>
        <span class="error">* '. $this->model["newPasswordErr"] .' </span>
        <br>
        <label for="new-password"><b>Herhaal nieuw wachtwoord: </b></label>
        <input class="password" type="password" name="new-password2" id="new-password2" maxlength="50" required>
        <span class="error">* '. $this->model["repeatNewPasswordErr"] .' </span>
        </fieldset>
        <button class="submit" type="submit">Wachtwoord veranderen</button>
        <input type="hidden" name="page" value="changepw" />';
    }
}

?>