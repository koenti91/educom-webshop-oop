<?php

function showRegisterHeader() {
    echo 'Registreren';
}

function showRegisterForm($data) {
echo '
<h3> Registreren</h3>

    <form action="index.php" method="post">
        <fieldset>
            <label for="name"><b>Naam: </b></label>
            <input class="name" type="text" name="name" value="'. $data["name"] .'" placeholder="Henk de Vries" maxlength="50" required>
            <span class="error">* '. $data["nameErr"] .' </span>
            <br>
            <label for="email"><b>Email: </b></label>
            <input class="email" type="text" name="email" value="'. $data["email"] .'" placeholder="henk74@gmail.com" maxlength="60" required>
            <span class="error">* '. $data ["emailErr"] .' </span>
            <br>
            <label for="password"><b>Wachtwoord: </b></label>
            <input class="password" type="password" name="password" value="'. $data["password"] .'" placeholder="Kies een wachtwoord." maxlength="20" required>
            <span class="error">* '. $data["passwordErr"] .' </span>
            <br>
            <label for="password-repeat"><b>Herhaal je wachtwoord: </b></label>
            <input class="password-repeat" type="password" name="password-repeat" value="'. $data["passwordRepeat"] .'" placeholder="Herhaal het gekozen wachtwoord." maxlength="20" required>
            <span class="error">* '. $data["passwordRepeatErr"] .' </span>
        </fieldset>
        <input class="submit" name="submit" type="submit" value="Doorgaan">
        <input type="hidden" name="page" value="register" />
    </form>';
}
?>