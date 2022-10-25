<?php 
require_once "forms_doc.php";

class LoginDoc extends FormsDoc {
    protected function showHeader () {
        echo 'Inloggen';
    }

    protected function showForm() {
        echo ' <fieldset>
        <label for="email"><b>E-mailadres: </b></label>
        <input class="email" type="email" name="email" placeholder="Vul je e-mailadres in." maxlength="60" value="' . $this->model->email . '" required>
        <span class="error">* ' . $this->model->emailErr . '</span>
          <br>
        <label for="password"><b>Wachtwoord: </b></label>
        <input class="password" type="password" name="password" placeholder="Vul hier je wachtwoord in." value ="' . $this->model->password . '"  maxlength="20" required>
        <span class="error">* ' . $this->model->passwordErr . '</span>
        <input type="submit" class="submit" value="Login" />
        <input type="hidden" name="page" value="login" />
  
        </fieldset>';
    }

}

?>