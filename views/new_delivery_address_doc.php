<?php 
require_once "basic_doc.php";

class NewDeliveryAddressDoc extends BasicDoc {
    
    protected function showHeader() {
        echo 'Nieuw afleveradres toevoegen ';
    }
    
    protected function ShowContent() {  
        echo '<form action="index.php" method="post">
            <fieldset>
                <div>
                    <label for ="address"><b>Adres: </b></label>
                    <input type="text" id="address" name="address" placeholder="Hoofdstraat 1" maxlength="100" value="'. getArrayVar($this->data, "address"). '" required>
                    <span class="error">* ' . getArrayVar($this->data, "addressErr") . '</span>
                </div>
                <div>
                    <label for ="zip_code"><b>Postcode: </b></label>
                    <input type="text" id="zip_code" name="zip_code" placeholder="1234AB" maxlength="6" value="' . getArrayVar($this->data, "zip_code"). '" required>
                    <span class="error">* ' . getArrayVar($this->data, "zipCodeErr"). '</span> 
                </div>
                <div>
                    <label for ="city"><b>Woonplaats: </b></label>
                    <input type ="text" id="city" name="city" placeholder="Meerdijk" maxlength="100" value="' . getArrayVar($this->data, "city"). '" required>
                    <span class="error">* ' . getArrayVar($this->data, "cityErr"). '</span>
                </div>
                <div>
                    <label for ="phone"><b>Telefoon: </b></label>
                    <input type ="tel" id="phone" name="phone" placeholder="0612345678" maxlength="10" value="' . getArrayVar($this->data, "phone"). '" required>
                    <span class="error">* ' . getArrayVar($this->data, "phoneErr"). '</span>
                </div>
            </fieldset>
            <input type="hidden" name="page" value="newDeliveryAddress" />
            <button class="submit" type="submit">Bevestigen</button>
        </form>
        ';
    }
}

?>