<?php 
require_once "forms_doc.php";

class NewDeliveryAddressDoc extends FormsDoc {
    
    protected function showHeader() {
        echo 'Nieuw afleveradres toevoegen ';
    }
    
    protected function showForm() {  
        echo '<form action="index.php" method="post">
            <fieldset>
                <div>
                    <label for ="address"><b>Adres: </b></label>
                    <input type="text" id="address" name="address" placeholder="Hoofdstraat 1" maxlength="100" value="'. getArrayVar($this->model, "address"). '" required>
                    <span class="error">* ' . getArrayVar($this->model, "addressErr") . '</span>
                </div>
                <div>
                    <label for ="zip_code"><b>Postcode: </b></label>
                    <input type="text" id="zip_code" name="zip_code" placeholder="1234AB" maxlength="6" value="' . getArrayVar($this->model, "zip_code"). '" required>
                    <span class="error">* ' . getArrayVar($this->model, "zipCodeErr"). '</span> 
                </div>
                <div>
                    <label for ="city"><b>Woonplaats: </b></label>
                    <input type ="text" id="city" name="city" placeholder="Meerdijk" maxlength="100" value="' . getArrayVar($this->model, "city"). '" required>
                    <span class="error">* ' . getArrayVar($this->model, "cityErr"). '</span>
                </div>
                <div>
                    <label for ="phone"><b>Telefoon: </b></label>
                    <input type ="tel" id="phone" name="phone" placeholder="0612345678" maxlength="10" value="' . getArrayVar($this->model, "phone"). '" required>
                    <span class="error">* ' . getArrayVar($this->model, "phoneErr"). '</span>
                </div>
            </fieldset>
            <input type="hidden" name="page" value="newDeliveryAddress" />
            <button class="submit" type="submit">Bevestigen</button>
        </form>
        ';
    }
}

?>