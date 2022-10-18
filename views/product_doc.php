<?php 
require_once "basic_doc.php";

class ProductDoc extends BasicDoc {
    protected function addActionForm($action, $buttonLabel, $nextPage, $productId = null, $showQuantity = false, $deliveryAddressId = null) {
        if($this->data['canOrder']) {
            echo '<form method="post" action="index.php">
            <input type="hidden" name="page" value="'.$nextPage.'">
            <input type="hidden" name="action" value="'.$action.'">';
            if ($showQuantity) {
                $cart = getArrayVar($this->data, 'cart', array());
                $currentValue = getArrayVar($cart, $productId, 1);
                echo '<input type="number" name="quantity" class="set-quantity" value="'.$currentValue.'" />';
            }
            if (!empty($productId)) {
                echo '<input type="hidden" name="productId" value="'.$productId.'">';
            }
            if (!empty($deliveryAddressId)) {
                echo '<input type="hidden" name="deliveryAddressId" value ="'.$deliveryAddressId.'" />';
            }
            echo '<input type="submit" name="submit" class="btn-btn" value="'.$buttonLabel.'">
            </form>';
        }
    }
    protected function showCartTable($canEdit = false) {
        echo '<div class="table-responsive">
                    <table class="table-bordered">
                        <tr class="table-headers">
                            <th>Product</th>
                            <th>Aantal</th>
                            <th>Prijs</th>
                            <th>Totaal</th>
                            ' . ($canEdit ? '<th>Verwijder</th>' : '') .'
                        </tr>';
                
            foreach($this->data["cartRows"] as $cartRow) {
                $this->showCartRow($cartRow, $canEdit);
            }      
                        
            echo '<tr class="total">
                    <td></td>
                    <td><b>Totaal</b></td>
                    <td></td>
                    <td><b> &euro; '.number_format($this->data['total'] / 100, 2).'</b></td>
                    '.($canEdit ? '<td></td>'  : '') .'
                  </tr>
            </table>
            </div>';
    }
    protected function showCartRow($cartRow, $canEdit) {
        echo '<tr class="data-row">
            <td><img src="Images/'.$cartRow['filename'].'" alt="'.$cartRow['name'].'" 
            width="50px"/><br>'.$cartRow["name"].'</td>
            <td>';
            if ($canEdit) { 
                $this->addActionForm("add-to-cart", "Bijwerken", "shoppingCart", $cartRow["productId"], true);
            } else {
                echo $cartRow['quantity'];
            }
            echo '</td>
            <td> &euro; '.number_format($cartRow["price"] / 100, 2).'</td>
            <td> &euro; '.number_format($cartRow['subtotal'] / 100, 2).'</td>';
            if ($canEdit) {
                echo '<td>';
                $this->addActionForm("delete", "Verwijder", "shoppingCart", $cartRow["productId"]);
                echo '</td>';
            }
        echo '</tr>';
    }
}

?>