<?php 
require_once "forms_doc.php";

class RegisterDoc extends FormsDoc {
    protected function ShowHeader() {
        echo 'Registreren';
    }

    protected function showForm() {
        echo '<fieldset>
        <label for="name"><b>Naam: </b></label>
        <input class="name" type="text" name="name" value="'. $this->data["name"] .'" placeholder="Henk de Vries" maxlength="50" required>
        <span class="error">* '. $this->data["nameErr"] .' </span>
        <br>
        <label for="email"><b>Email: </b></label>
        <input class="email" type="text" name="email" value="'. $this->data["email"] .'" placeholder="henk74@gmail.com" maxlength="60" required>
        <span class="error">* '. $this->data ["emailErr"] .' </span>
        <br>
        <label for="password"><b>Wachtwoord: </b></label>
        <input class="password" type="password" name="password" value="'. $this->data["password"] .'" placeholder="Kies een wachtwoord." maxlength="20" required>
        <span class="error">* '. $this->data["passwordErr"] .' </span>
        <br>
        <label for="password-repeat"><b>Herhaal je wachtwoord: </b></label>
        <input class="password-repeat" type="password" name="password-repeat" value="'. $this->data["passwordRepeat"] .'" placeholder="Herhaal het gekozen wachtwoord." maxlength="20" required>
        <span class="error">* '. $this->data["passwordRepeatErr"] .' </span>
        </fieldset>
        <input class="submit" name="submit" type="submit" value="Doorgaan">
        <input type="hidden" name="page" value="register" />';
    }
}

?>