<?php

function showDeliveryAddressHeader() {
    echo 'Afleveradres';
}

function chooseDeliveryAddress($data) {
    $rows = getShoppingCartRows();
    echo '<h3> Jouw gegevens: </h3>';
    
    echo '<fieldset>';
    echo 'Naam: '.$data['user']["name"];
    echo '<br>';
    echo 'E-mailadres: '.$data['user']["email"];
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

function addNewDeliveryAddress($data) {      
    echo '<form action="index.php" method="post">
        <fieldset>
            <div>
                <label for ="address"><b>Adres: </b></label>
                <input type="text" id="address" name="address" placeholder="Hoofdstraat 1" maxlength="100" value="'. getArrayVar($data, "address"). '" required>
                <span class="error">* ' . getArrayVar($data, "addressErr") . '</span>
            </div>
            <div>
                <label for ="zip_code"><b>Postcode: </b></label>
                <input type="text" id="zip_code" name="zip_code" placeholder="1234AB" maxlength="6" value="' . getArrayVar($data, "zip_code"). '" required>
                <span class="error">* ' . getArrayVar($data, "zipCodeErr"). '</span> 
            </div>
            <div>
                <label for ="city"><b>Woonplaats: </b></label>
                <input type ="text" id="city" name="city" placeholder="Meerdijk" maxlength="100" value="' . getArrayVar($data, "city"). '" required>
                <span class="error">* ' . getArrayVar($data, "cityErr"). '</span>
            </div>
            <div>
                <label for ="phone"><b>Telefoon: </b></label>
                <input type ="tel" id="phone" name="phone" placeholder="0612345678" maxlength="10" value="' . getArrayVar($data, "phone"). '" required>
                <span class="error">* ' . getArrayVar($data, "phoneErr"). '</span>
            </div>
        </fieldset>
        <input type="hidden" name="page" value="newDeliveryAddress" />
        <button class="submit" type="submit">Bevestigen</button>
    </form>
    ';
}

?>