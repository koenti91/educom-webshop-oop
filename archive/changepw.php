<?php

function showChangePwHeader() {
    echo ' Wachtwoord veranderen';
}

function showChangePwContent() {
    $data = validateContact();
    if (!$data ["valid"]) {
        showChangePwForm ($data);
        } else {
        showChangePwConfirmationMessage ($data);
    }
}

function showChangePwForm($data) {
    echo '
   <h3> Wachtwoord veranderen</h3>

    <form action="" method="post">
							
    <fieldset>
        <label for="current-password"><b>Oud wachtwoord: </b></label>
        <input class="password" type="password" name="current-password" id="current-password" maxlength="50" required>
        <span class="error">* '. $data["oldPasswordErr"] .' </span>
        <br>
        <label for="new-password"><b>Nieuw wachtwoord: </b></label>
        <input class="password" type="password" name="new-password" id="new-password" maxlength="50" required>
        <span class="error">* '. $data["newPasswordErr"] .' </span>
        <br>
        <label for="new-password"><b>Herhaal nieuw wachtwoord: </b></label>
        <input class="password" type="password" name="new-password2" id="new-password2" maxlength="50" required>
        <span class="error">* '. $data["repeatNewPasswordErr"] .' </span>
        </fieldset>
        <button class="submit" type="submit">Wachtwoord veranderen</button>
        <input type="hidden" name="page" value="changepw" />
    
</form>';
}

function showChangePwConfirmationMessage() {
    echo
    '<p> Je wachtwoord is gewijzigd.</p>';
}
?>