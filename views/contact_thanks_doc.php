<?php
require_once "contact_doc.php";

class ContactThanksDoc extends ContactDoc {
    protected function showContent()
    {
        echo '<p class="bedankt">Bedankt voor het invullen. Ik neem zo snel mogelijk contact met je op!</p>
            <h2>Jouw gegevens:</h2>
            <div class="results">';
            echo 'Aanhef: ' . GENDERS[$this->data["gender"]];
            echo "<br>";
            echo 'Naam: ' . $this->data["name"];
            echo "<br>";
            echo 'E-mailadres: ' . $this->data["email"];
            echo "<br>";
            echo ' Telefoonnummer: ' . $this->data["phone"];
            echo "<br>";
            echo ' Voorkeur voor: ' . PREFERRED[$this->data["preferred"]];
            echo "<br>";
            echo ' Opmerking: ' . $this->data["question"];
            echo '</div>';
        }
}

?>