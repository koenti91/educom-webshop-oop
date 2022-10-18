<?php
require_once "basic_doc.php";

class DeliveryAddressDoc extends BasicDoc {
    
    protected function showHeader() {
        echo 'Bezorgadres kiezen';
    }

    protected function showContent () {
        echo '<h3> Jouw gegevens: </h3>';
        
        echo '<fieldset>';
        echo 'Naam: '.$this->data['user']['name'];
        echo '<br>';
        echo 'E-mailadres: '.$this->data['user']['email'];
        echo '<br>';
        echo '</fieldset>';
    
        
        echo '<form action="index.php" method="post">';
        
            echo '<fieldset>
                <label for="delivery-address"><b>Afleveradres: </b></label>
                <select class="delivery-address" name="deliveryAddressId" id="delivery-address" required>
                <option value="0">Vul een nieuw afleveradres in</option>';
            if (count($this->data['addresses']) > 0) {
                foreach ($this->data['addresses'] as $address) {
                    $selected = $address['is_default'] ? ' selected' : '';
                    echo '<option value="'.$address['id'].''.$selected.'">'.$address['address'].' '.$address['city'].'</option>';
                }
            } else {
                echo '<input type="hidden" name="delivery-address" value="0">';
            }
            echo '
            </select>
            <span class="error">* ' . $this->data["deliveryAddressIdErr"] ?? '' . '</span>
            </fieldset>';
            echo '<input type="hidden" name="page" value="deliveryAddress">
            <button class="submit" type="submit">Volgende</button>
            </form>';
    }
}

?>