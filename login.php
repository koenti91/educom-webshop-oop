<?php

function showLoginHeader() {
    echo ' Login';
}

function showLoginForm($data) {
    echo '
    <h3> Login</h3>

    <form action="index.php?page=home" method="post">

    <fieldset>
      <label for="email"><b>E-mailadres: </b></label>
      <input class="email" type="email" name="email" placeholder="Vul je e-mailadres in." maxlength="60" value="' . $data["email"] . '" required>
      <span class="error">*</span>
        <br>
      <label for="password"><b>Wachtwoord: </b></label>
      <input class="password" type="password" name="password" placeholder="Vul hier je wachtwoord in." value ="' . $data["password"] . '"  maxlength="20" required>
      <span class="error">*</span>
        <br>
      <span class="error2">' . $data["emailErr"] . '</span>
        <br>
      <input type="submit" class="submit" value="Login" />
      <input type="hidden" name="page" value="login" />

    </fieldset>
    </form>';
}

?>