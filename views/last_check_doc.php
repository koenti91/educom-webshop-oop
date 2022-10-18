<?php
require_once "product_doc.php";

class LastCheckDoc extends ProductDoc {
    protected function showHeader () {
        echo 'Bestelgegevens';
    }

    protected function showContent() {
        $user = $this->data['user'];
        
        echo '<form method="post" action="index.php">';
        echo '<div class="order-info">';
        echo '<fieldset>';
        echo '<b>Naam: </b>'.$user["name"];
        echo '<br>';
        echo '<b>E-mailadres: </b>'.$user["email"];
        echo '<br>';
        echo '<b>Telefoonnummer: </b>'.$this->data["phone"];
        echo '</fieldset>';
        echo '<fieldset>';
        echo '<b>Adres: </b>'.$this->data["address"];
        echo '<br>';
        echo '<b>Postcode: </b>'.$this->data["zip_code"];
        echo' <br>';
        echo '<b>Woonplaats: </b>'.$this->data["city"];
        echo '<br>';
        echo '</fieldset>';
        
        echo '<div class="order-info">';
        $this->showCartTable(false);
        $this->AddActionForm("orderConfirmation", "Bestelling afronden", "orderConfirmation", deliveryAddressId: $this->data["deliveryAddressId"]);
        echo '</div>';
        echo '</form>';
    }
}

?>