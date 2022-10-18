<?php
require_once 'product_doc.php';

class ShoppingCartDoc extends ProductDoc {
    
    protected function showHeader() {
        echo 'Winkelmand';
    }

    protected function showContent() {
        echo '<img class="icon" src="Images/shoppingcart.jpg" alt="Winkelwagen" width="100px" />';

        if (!empty($this->data['cartRows'])) {
            
            $this->showCartTable(true);
            $this->showDeliveryPageButton();
            
         } else {
            echo '<p>Je hebt nog geen producten aan je winkelmandje toegevoegd.</p>';
        }
    }

    private function showDeliveryPageButton() { 
        echo '<a href="index.php?page=deliveryAddress"><button>Naar gegevens</button></a>';
    }
}

?>