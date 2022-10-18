<?php
require_once "basic_doc.php";

class DeliveryAddressDoc extends BasicDoc {
    
    protected function showHeader() {
        echo 'Bezorgadres kiezen';
    }

    protected function showContent () {
        $data = $this->data['adresses'];
        $rows = getShoppingCartRows();
        echo '<h3> Jouw gegevens: </h3>';
        
        echo '<fieldset>';
        echo 'Naam: '.$this->data['username'];
        echo '<br>';
        echo 'E-mailadres: '.$this->$data['user_email'];
        echo '<br>';
        echo '</fieldset>';
    
        
        echo '<form action="index.php" method="post">';
        
            echo '<fieldset>
                <label for="delivery-address"><b>Afleveradres: </b></label>
                <select class="delivery-address" name="deliveryAddressId" id="delivery-address" required>
                <option value="0">Vul een nieuw afleveradres in</option>';
            if (count($data['addresses']) > 0) {
                foreach ($data['addresses'] as $address) {
                    $selected = $address['is_default'] ? ' selected' : '';
                    echo '<option value="'.$address['id'].''.$selected.'">'.$address['address'].' '.$address['city'].'</option>';
                }
            } else {
                echo '<input type="hidden" name="delivery-address" value="0">';
            }
            echo '
            </select>
            <span class="error">* ' . $data["deliveryAddressIdErr"] ?? '' . '</span>
            </fieldset>';
            echo '<input type="hidden" name="page" value="deliveryAddress">
            <button class="submit" type="submit">Volgende</button>
            </form>';
    }
}

?>