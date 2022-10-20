<?php
require_once "product_doc.php";

class LastCheckDoc extends ProductDoc {
    protected function showHeader () {
        echo 'Bestelgegevens';
    }

    protected function showContent() {
        $user = $this->model['user'];
        
        echo '<form method="post" action="index.php">';
        echo '<div class="order-info">';
        echo '<fieldset>';
        echo '<b>Naam: </b>'.$user["name"];
        echo '<br>';
        echo '<b>E-mailadres: </b>'.$user["email"];
        echo '<br>';
        echo '<b>Telefoonnummer: </b>'.$this->model["phone"];
        echo '</fieldset>';
        echo '<fieldset>';
        echo '<b>Adres: </b>'.$this->model["address"];
        echo '<br>';
        echo '<b>Postcode: </b>'.$this->model["zip_code"];
        echo' <br>';
        echo '<b>Woonplaats: </b>'.$this->model["city"];
        echo '<br>';
        echo '</fieldset>';
        
        echo '<div class="order-info">';
        $this->showCartTable(false);
        $this->AddActionForm("orderConfirmation", "Bestelling afronden", "orderConfirmation", deliveryAddressId: $this->model["deliveryAddressId"]);
        echo '</div>';
        echo '</form>';
    }
}

?>