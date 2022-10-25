<?php 
require_once "basic_doc.php";

class ProductDoc extends BasicDoc {
    protected function addActionForm($action, $buttonLabel, $nextPage, $productId = null, $showQuantity = false, $deliveryAddressId = null) {
        if($this->model->canOrder) {
            echo '<form method="post" action="index.php">
            <input type="hidden" name="page" value="'.$nextPage.'">
            <input type="hidden" name="action" value="'.$action.'">';
            if ($showQuantity) {
                $this->cart = getArrayVar($this->model, 'cart', array());
                $currentValue = getArrayVar($this->cart, $productId, 1);
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
    protected function showCartTable() {
        echo '<div class="table-responsive">
                    <table class="table-bordered">
                        <tr class="table-headers">
                            <th>Product</th>
                            <th>Aantal</th>
                            <th>Prijs</th>
                            <th>Totaal</th>
                            ' . ($this->canEdit ? '<th>Verwijder</th>' : '') .'
                        </tr>';
                
            foreach($this->model->cartRows as $cartRow) {
                $this->showCartRow($cartRow, $this->canEdit);
            }      
                        
            echo '<tr class="total">
                    <td></td>
                    <td><b>Totaal</b></td>
                    <td></td>
                    <td><b> &euro; '.number_format($this->model->total / 100, 2).'</b></td>
                    '.($this->canEdit ? '<td></td>'  : '') .'
                  </tr>
            </table>
            </div>';
    }
    protected function showCartRow() {
        echo '<tr class="model-row">
            <td><img src="Images/'.$this->cartRow->filename.'" alt="'.$this->cartRow->name.'" 
            width="50px"/><br>'.$this->cartRow->name.'</td>
            <td>';
            if ($this->canEdit) { 
                $this->addActionForm("add-to-cart", "Bijwerken", "shoppingCart", $this->cartRow->productId, true);
            } else {
                echo $this->cartRow->quantity;
            }
            echo '</td>
            <td> &euro; '.number_format($this->cartRow->price / 100, 2).'</td>
            <td> &euro; '.number_format($this->cartRow->subtotal / 100, 2).'</td>';
            if ($this->canEdit) {
                echo '<td>';
                $this->addActionForm("delete", "Verwijder", "shoppingCart", $this->cartRow->productId);
                echo '</td>';
            }
        echo '</tr>';
    }
}

?>