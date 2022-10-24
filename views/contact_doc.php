<?php 
require_once "forms_doc.php";
require_once "constants.php";

class ContactDoc extends FormsDoc {
    protected function showHeader()
    {
        echo 'Contactformulier';
    }
    
    protected function showForm(){

        echo '<fieldset>
            <label for="gender"><b>Aanhef:</b></label>
            <select class="gender" name="gender" id="gender" required>
              <option value="">Kies aanhef</option>';
                foreach(GENDERS as $gender_key => $gender_value) {
                    echo '<option value="' . $gender_key . '"';
                    if ($this->model->gender == $gender_key) { 
                        echo ' selected="selected"'; 
                    }
                    echo '>' . $gender_value . '</option>' .PHP_EOL; 
                } 
            echo '</select>
            <span class="error">* ' . $this->model->genderErr . '</span>
            <br>
            <label for="name"><b>Naam: </b></label>
            <input class="name" type="text" id="name" name="name" placeholder="Henk de Vries" maxlength="50" value="' . $this->model->name . '" required>
            <span class="error">* ' . $this->model->nameErr . '</span>
            <br>
            <label for="email"><b>E-mail: </b></label>
            <input class="email" type="email" id="email" name="email" placeholder="henk74@gmail.com" maxlength="60" value="' . $this->model->email . '" required>
            <span class="error">* ' . $this->model->emailErr . '</span>
            <br>
            <label for="phone"><b>Telefoon: </b></label>
            <input class="phone" type="text" id="phone" name="phone" placeholder="0612345678" maxlength="10" pattern="[0-9]{10}" value="' . $this->model->phone . '" required>
            <span class="error">* ' . $this->model->phoneErr . '</span>
            </fieldset>
                
            <fieldset>
                <label class="choose"   for="preferred"><b>Voorkeur contact: </b></label>';
                    foreach(PREFERRED as $preferred_key => $preferred_value) {
                        echo '<input type="radio" id="pref-' . $preferred_key . '" name="preferred" '; 
                        if ($this->model->preferred ==$preferred_key) { echo "checked";}
                        echo ' value="'.$preferred_key.'"> ' . PHP_EOL . '<label for="pref-' . $preferred_key . '" class="option">'.$preferred_value.'</label>' . PHP_EOL; 
                    }
            echo' <span class="error">* ' . $this->model->preferredErr . '</span>
                    <br>

                <label for="question"><b>Opmerking: </b></label>
                <textarea type="text" id="question" name="question" maxlength="1000" placeholder="Iets:)">' . $this->model->question . '</textarea>
                <span class="error">* ' . $this->model->questionErr . '</span>
            </fieldset>
            <input class="submit" name="submit" type="submit" value="Versturen">
            <input type="hidden" name="page" value="contact" />';
    }
}

?>