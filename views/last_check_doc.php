<?php
require_once "product_doc.php";

class LastCheckDoc extends ProductDoc {
    protected function showHeader () {
        echo 'Bestelgegevens';
    }

    protected function showContent() {
        
        echo '<form method="post" action="index.php">';
        echo '<div class="order-info">';
        echo '<fieldset>';
        echo '<b>Naam: </b>'.$this->model->user->name;
        echo '<br>';
        echo '<b>E-mailadres: </b>'.$this->model->user->email;
        echo '<br>';
        echo '<b>Telefoonnummer: </b>'.$this->model->deliveryAddress->phone;
        echo '</fieldset>';
        echo '<fieldset>';
        echo '<b>Adres: </b>'.$this->model->deliveryAddress->address;
        echo '<br>';
        echo '<b>Postcode: </b>'.$this->model->deliveryAddress->zip_code;
        echo' <br>';
        echo '<b>Woonplaats: </b>'.$this->model->deliveryAddress->city;
        echo '<br>';
        echo '</fieldset>';
        
        echo '<div class="order-info">';
        $this->showCartTable(false);
        $this->addActionForm("lastCheck", "Bestelling afronden", "lastCheck", deliveryAddressId: $this->model->deliveryAddressId);
        echo '</div>';
        echo '</form>';
    }
}
