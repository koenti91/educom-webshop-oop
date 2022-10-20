<?php 
require_once "forms_doc.php";

class RegisterDoc extends FormsDoc {
    protected function ShowHeader() {
        echo 'Registreren';
    }

    protected function showForm() {
        echo '<fieldset>
        <label for="name"><b>Naam: </b></label>
        <input class="name" type="text" name="name" value="'. $this->model["name"] .'" placeholder="Henk de Vries" maxlength="50" required>
        <span class="error">* '. $this->model["nameErr"] .' </span>
        <br>
        <label for="email"><b>Email: </b></label>
        <input class="email" type="text" name="email" value="'. $this->model["email"] .'" placeholder="henk74@gmail.com" maxlength="60" required>
        <span class="error">* '. $this->model ["emailErr"] .' </span>
        <br>
        <label for="password"><b>Wachtwoord: </b></label>
        <input class="password" type="password" name="password" value="'. $this->model["password"] .'" placeholder="Kies een wachtwoord." maxlength="20" required>
        <span class="error">* '. $this->model["passwordErr"] .' </span>
        <br>
        <label for="password-repeat"><b>Herhaal je wachtwoord: </b></label>
        <input class="password-repeat" type="password" name="password-repeat" value="'. $this->model["passwordRepeat"] .'" placeholder="Herhaal het gekozen wachtwoord." maxlength="20" required>
        <span class="error">* '. $this->model["passwordRepeatErr"] .' </span>
        </fieldset>
        <input class="submit" name="submit" type="submit" value="Doorgaan">
        <input type="hidden" name="page" value="register" />';
    }
}

?>