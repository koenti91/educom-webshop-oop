<?php
require_once "forms_doc.php";

class DeliveryAddressDoc extends FormsDoc {
    
    protected function showHeader() {
        echo 'Bezorgadres kiezen';
    }

    protected function showForm () {
        echo '<h3> Jouw gegevens: </h3>';
        
        echo '<fieldset>';
        echo 'Naam: '.$this->model->user->name;
        echo '<br>';
        echo 'E-mailadres: '.$this->model->user->email;
        echo '<br>';
        echo '</fieldset>';
        if (count($this->model->addresses) > 0) {
            echo '<fieldset>
            <label for="delivery-address"><b>Afleveradres: </b></label>
            <select class="delivery-address" name="deliveryAddressId" id="delivery-address" required>
            <option value="0">Vul een nieuw afleveradres in</option>';
            foreach ($this->model->addresses as $address) {
                
                $this->selected = $address->is_default ? ' selected' : '';
                echo '<option value="'.$address->id.''.$this->selected.'">'.$address->address.' '.$address->city.'</option>';
            }
            echo '</select><span class="error"> * ' . $this->model->deliveryAddressIdErr . '</span> </fieldset>';
        } else {
            echo '<input type="hidden" name="delivery-address" value="0">';
        }
        echo '<input type="hidden" name="page" value="deliveryAddress">
        <button class="submit" type="submit">Volgende</button>';
    }
}

?>