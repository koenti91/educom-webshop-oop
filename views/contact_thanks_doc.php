<?php
require_once "basic_doc.php";
require_once "forms_doc.php";

class ContactThanksDoc extends BasicDoc {
    protected function showContent()
    {
        echo '<p class="bedankt">Bedankt voor het invullen. Ik neem zo snel mogelijk contact met je op!</p>
            <h2>Jouw gegevens:</h2>
            <div class="results">';
            echo 'Aanhef: ' . GENDERS[$this->model->gender];
            echo "<br>";
            echo 'Naam: ' . $this->model->name;
            echo "<br>";
            echo 'E-mailadres: ' . $this->model->email;
            echo "<br>";
            echo ' Telefoonnummer: ' . $this->model->phone;
            echo "<br>";
            echo ' Voorkeur voor: ' . PREFERRED[$this->model->preferred];
            echo "<br>";
            echo ' Opmerking: ' . $this->model->question;
            echo '</div>';
        }
}

?>