<?php

function showContactHeader() {
    echo 'Contactformulier';
}

function showContactContent () {
    $data = validateContact();
    if (!$data ["valid"]) {
        showContactForm ($data);
        } else {
        showContactThanks ($data);
    }
}

function showContactForm($data) {
    echo '<form action="index.php" method="post">
            <fieldset>
            <label for="gender"><b>Aanhef:</b></label>
            <select class="gender" name="gender" id="gender" required>
              <option value="">Kies aanhef</option>';
                foreach(GENDERS as $gender_key => $gender_value) {
                    echo '<option value="' . $gender_key . '"';
                    if ($data["gender"] == $gender_key) { 
                        echo ' selected="selected"'; 
                    }
                    echo '>' . $gender_value . '</option>' . PHP_EOL; 
                } 
 
            echo'</select>
            <span class="error">* ' . $data["genderErr"] . '</span>
            <br>
            <label for="name"><b>Naam: </b></label>
            <input class="name" type="text" id="name" name="name" placeholder="Henk de Vries" maxlength="50" value="' . $data["name"] . '" required>
            <span class="error">* ' . $data["nameErr"] . '</span>
            <br>
            <label for="email"><b>E-mail: </b></label>
            <input class="email" type="email" id="email" name="email" placeholder="henk74@gmail.com" maxlength="60" value="' . $data["email"] . '" required>
            <span class="error">* ' . $data["emailErr"] . '</span>
            <br>
            <label for="phone"><b>Telefoon: </b></label>
            <input class="phone" type="text" id="phone" name="phone" placeholder="0612345678" maxlength="10" pattern="[0-9]{10}" value="' . $data["phone"] . '" required>
            <span class="error">* ' . $data["phoneErr"] . '</span>
            </fieldset>
                
            <fieldset>
                <label class="choose"   for="preferred"><b>Voorkeur contact: </b></label>';
                    foreach(PREFERRED as $preferred_key => $preferred_value) {
                        echo '<input type="radio" id="pref-' . $preferred_key . '" name="preferred" '; 
                        if ($data["preferred"]==$preferred_key) { echo "checked";}
                        echo ' value="'.$preferred_key.'"> ' . PHP_EOL . '<label for="pref-' . $preferred_key . '" class="option">'.$preferred_value.'</label>' . PHP_EOL; 
                    }
                echo'     
                <span class="error">* ' . $data["preferredErr"] . '</span>
                <br>

                <label for="question"><b>Opmerking: </b></label>
                <textarea type="text" id="question" name="question" maxlength="1000" placeholder="Iets:)">' . $data["question"] . '</textarea>
                <span class="error">* ' . $data["questionErr"] . '</span>
            </fieldset>
            <input class="submit" name="submit" type="submit" value="Versturen">
            <input type="hidden" name="page" value="contact" />
            </form> ';
}

function showContactThanks($data) {
    echo
        '<p class="bedankt">Bedankt voor het invullen. Ik neem zo snel mogelijk contact met je op!</p>
        <h2>Jouw gegevens:</h2>
        <div class="results">';
        echo 'Aanhef: ' . GENDERS[$data["gender"]];
        echo "<br>";
        echo 'Naam: ' . $data["name"];
        echo "<br>";
        echo 'E-mailadres: ' . $data["email"];
        echo "<br>";
        echo ' Telefoonnummer: ' . $data["phone"];
        echo "<br>";
        echo ' Voorkeur voor: ' . PREFERRED[$data["preferred"]];
        echo "<br>";
        echo ' Opmerking: ' . $data["question"];
        echo '</div>';
}
?>