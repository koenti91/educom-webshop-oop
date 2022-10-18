<?php
require_once "basic_doc.php";

class LastCheckDoc extends BasicDoc {
    protected function showHeader () {
        echo 'Bestelgegevens';
    }

    protected function showContent() {
        $user = $this->data;
        
        echo '<form method="post" action="index.php">';
        echo '<div class="order-info">';
        echo '<fieldset>';
        echo '<b>Naam: </b>'.$user["name"];
        echo '<br>';
        echo '<b>E-mailadres: </b>'.$user["email"];
        echo '<br>';
        echo '<b>Telefoonnummer: </b>0'.$this->data["phone"];
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
        echo '<table class="table-responsive">
                <tr class="table-headers">
                    <th>Product</th>
                    <th>Aantal</th>
                    <th>Prijs</th>
                    <th>Totaal</th>
                </tr>';
        foreach ($this->data["cartRows"] as $row) {
        echo '<tr class="data-row">';
        echo '<td><img src="Images/'.$row["filename"].'" alt="'.$row["name"].'"
                width="50px" /><br>'.$row["name"].'</td>';
        echo '<td> '.$row["quantity"].'</td>';
        echo '<td> &euro; '.number_format($row["price"] / 100, 2).'</td>';
        echo '<td> &euro; '.number_format($row['subtotal'] / 100, 2).'</td>';
        echo '</tr>';
        }
        echo '<tr class="total">
                <td></td>
                <td><b>Totaal</b></td>
                <td></td>
                <td><b> &euro; '.number_format($this->data['total'] / 100, 2).'</b></td>
              </tr></div></table>';
        
        echo '<input class="submit" name="submit" type="submit" value="Bestelling afronden">';
        echo '<input type="hidden" name="action" value="orderConfirmation" />';
        echo '<input type="hidden" name="page" value="orderConfirmation" />';
        echo '<input type="hidden" name="deliveryAddressId" value ="'.$this->data["deliveryAddressId"].'" />';
        echo '</div>';
        echo '</form>';
    }
}

?>