<?php
require_once 'product_doc.php';

class ShoppingCartDoc extends ProductDoc {
    
    protected function showHeader() {
        echo 'Winkelmand';
    }

    protected function showContent() {
        echo '<img class="icon" src="Images/shoppingcart.jpg" alt="Winkelwagen" width="100px" />';

        $cartRows = $this->data['cartRows'];

        if (!empty($cartRows)) {
            echo '<div class="table-responsive">
                    <table class="table-bordered">
                        <tr class="table-headers">
                            <th>Product</th>
                            <th>Aantal</th>
                            <th>Prijs</th>
                            <th>Totaal</th>
                            <th>Verwijder</th>
                        </tr>';
                
            foreach($cartRows as $cartRow) {
                $this->showCartRow($cartRow);
            }      
                        
            echo '<tr class="total">
                    <td></td>
                    <td><b>Totaal</b></td>
                    <td></td>
                    <td></td>
                    <td><b> &euro; '.number_format($this->data['total'] / 100, 2).'</b></td>
                  </tr>
            </table>
            </div>';
            
            $this->showDeliveryPageButton($this->data);
            
         } else {
            echo '<p>Je hebt nog geen producten aan je winkelmandje toegevoegd.</p>';
        }
    }
    
    private function showCartRow($cartRow) {
        echo '<tr class="data-row">
            <td><img src="Images/'.$cartRow['filename'].'" alt="'.$cartRow['name'].'" 
            width="50px"/><br>'.$cartRow["name"].'</td>
            <td>';
            addActionForm("add-to-cart", "Bijwerken", "shoppingCart", $cartRow["productId"], true);
            echo '</td>
            <td> &euro; '.number_format($cartRow["price"] / 100, 2).'</td>
            <td> &euro; '.number_format($cartRow['subtotal'] / 100, 2).'</td><td>';
        $this->addActionForm("delete", "Verwijder", "shoppingCart", $cartRow["productId"]);
        echo '</td></tr>';
    }

    private function showDeliveryPageButton($data) { 
            if (!empty ($data['cartRows'])) {
                echo '<a href="index.php?page=deliveryAddress"><button>Naar gegevens</button></a>';
            }
    }
}

?>