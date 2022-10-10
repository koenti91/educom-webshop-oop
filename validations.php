<?php

require_once ("user_service.php");

function validateLogin() {
        $email = $password = '';
        $emailErr = $passwordErr = '';
        $valid = false;
        $name = '';
        $userId = '';

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            
            $email = testInput(getPostVar("email"));
            if (empty($email)) {
                $emailErr = "Vul je e-mailadres in.";
            }
    
            $password = testInput(getPostVar("password"));
            if (empty($password)) {
                $passwordErr = "Vul je gekozen wachtwoord in.";
            }
    
            if (empty($emailErr) && empty($passwordErr)) {
                $valid = true;
            }
    
            if ($valid) {
                $user = authenticateUser ($email, $password);
                if (empty($user)) {
                    $valid = false;
                    $emailErr = "E-mailadres is niet bekend of wachtwoord wordt niet herkend.";
                } else {
                    $email = $user["email"];
                    $name = $user["name"];
                    $userId = $user["id"];
                }
            }
        }
        
        return array(
                    "email" => $email, 
                    "password" => $password, 
                    "name" => $name,
                    "userId" => $userId,
                    "emailErr" => $emailErr, 
                    "passwordErr" => $passwordErr, 
                    "valid" => $valid);
    }

    function validateRegister() {
        $name = $email = $password = $passwordRepeat = '';
        $nameErr = $emailErr = $passwordErr = $passwordRepeatErr = '';
        $valid = false;
    
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
            $name = testInput(getPostvar("name"));
            if (empty($name)) {
                $nameErr = "Naam is verplicht";
            } 
            else if (!preg_match("/^[a-zA-Z' ]*$/",$name)) {
                $nameErr = "Alleen letters en spaties zijn toegestaan."; 
            }
            
            $email = testInput(getPostVar("email")); 
            if (empty($email)) {
                $emailErr = "E-mail is verplicht";
            }
            else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $emailErr = "Vul een correct e-mailadres in.";
            }
    
            $password = testInput(getPostvar("password"));
            if (empty($password)) {
                $passwordErr = "Vul hier een wachtwoord in.";
            }
            else {
                $errors = array();
                if (!preg_match('@[A-Z]@', $password)) { 
                    array_push($errors, "een hoofdletter");
                }
               
                if (!preg_match('@[a-z]@', $password)) {
                    array_push($errors, "een kleine letter");    
                }
                if (!preg_match('@[0-9]@', $password)) {
                    array_push($errors, "een cijfer");
                }
                if (!preg_match('@[^\w]@', $password)) {
                    array_push($errors, "een speciaal teken");
                }
                if (strlen($password) < 8) {
                    array_push($errors, "acht tekens");
                }
                if (!empty($errors)) {
                    $passwordErr = "Wachtwoord moet tenminste " . implode(", ", $errors) . " bevatten.";
                }
            }
    
            $passwordRepeat = testInput(getPostvar("password-repeat"));
            if (empty($passwordRepeat)) {
                $passwordRepeatErr = "Herhaal hier je gekozen wachtwoord.";
            }
            else if ($password != $passwordRepeat) {
                $passwordRepeatErr = "Je wachtwoorden komen niet overeen.";
            }
    
            if (empty($nameErr) && empty($emailErr) && empty($passwordErr) && empty($passwordRepeatErr)){
                if (empty(findUserByEmail($email))){
                    $valid = true;
                } else {
                    $emailErr = "E-mailadres is al in gebruik.";
                }
            }   
        }
    
        return array ("name" => $name, "email" => $email, "password" => $password, "passwordRepeat" => $passwordRepeat,
                        "nameErr" => $nameErr, "emailErr" => $emailErr, "passwordErr" => $passwordErr,
                        "passwordRepeatErr" => $passwordRepeatErr, "valid" => $valid); 
    }

    function validateContact () {
        $gender = $name = $email = $phone = $preferred = $question = '';
        $genderErr = $nameErr = $emailErr = $phoneErr = $preferredErr = $questionErr = '';
        $valid = false;
    
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            
            $gender = testInput(getPostVar("gender"));
            if (empty($gender)) { 
                $genderErr = "Aanhef is verplicht.";
            } else if (!array_key_exists($gender, GENDERS)) {
                $genderErr = "Aanhef is niet correct.";
            }
    
            $name = testInput(getPostVar("name"));
            if (empty($name)) {
                $nameErr = "Naam is verplicht";
            }
                else if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
                $nameErr = "Alleen letters en spaties zijn toegestaan.";
            }
            
            $email = testInput(getPostVar("email"));
            if (empty($email)) {
                $emailErr = "E-mail is verplicht";
            } 
                else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Vul een correct e-mailadres in";
            }
            
            $phone = testInput(getPostVar("phone"));
            if (empty($phone)) {
                $phoneErr = "Telefoonnummer is verplicht";
            } 
                else if (!preg_match("/^0([0-9]{9})$/",$phone)) {
                $phoneErr = "Vul een geldig telefoonnummer in.";
            }
    
            $preferred = testInput(getPostVar("preferred"));
            if (!isset($preferred)) {  
                $preferredErr = "Vul een voorkeur in."; 
            } 
                else if (!array_key_exists($preferred, PREFERRED)) {
                $preferredErr = "Vul een voorkeur in.";  
            }
    
            $question = testInput(getPostVar("question"));    
            if (empty($question)) {
                $questionErr = " Vul hier je vraag of opmerking in.";
            }   
                else {
                $question = testInput($_POST["question"]);
            }  
    
            if (empty($genderErr) && empty($nameErr) && empty($emailErr) && 
                empty($phoneErr) && empty($preferredErr) && empty($questionErr))  {
           
                $valid = true;
            } 
         }
         return array("gender" => $gender, "genderErr" => $genderErr, 
                        "name" => $name, "nameErr" => $nameErr, "email" => $email, 
                        "emailErr" => $emailErr, "phone" => $phone, "phoneErr" => $phoneErr,  
                        "preferred" => $preferred, "preferredErr" => $preferredErr, 
                        "question" => $question, "questionErr" => $questionErr,
                        "valid" => $valid);
    }
    
    function testInput($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

function validateChangePassword() {
    $oldPassword = $newPassword = $repeatNewPassword = '';
    $oldPasswordErr = $newPasswordErr = $repeatNewPasswordErr = '';
    $valid = false;

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $oldPassword = testInput(getPostvar("current-password"));
            if (empty($oldPassword)) {
                $oldPasswordErr = "Vul hier je oude wachtwoord in.";
            }

        $newPassword = testInput(getPostvar("new-password"));
            if (empty($newPassword)) {
                $newPasswordErr = "Vul hier je nieuwe wachtwoord in.";
            }
            else {
                $errors = array();
                if (!preg_match('@[A-Z]@', $newPassword)) { 
                    array_push($errors, "een hoofdletter");
                }
               
                if (!preg_match('@[a-z]@', $newPassword)) {
                    array_push($errors, "een kleine letter");    
                }
                if (!preg_match('@[0-9]@', $newPassword)) {
                    array_push($errors, "een cijfer");
                }
                if (!preg_match('@[^\w]@', $newPassword)) {
                    array_push($errors, "een speciaal teken");
                }
                if (strlen($newPassword) < 8) {
                    array_push($errors, "acht tekens");
                }
                if (!empty($errors)) {
                    $newPasswordErr = "Wachtwoord moet tenminste " . implode(", ", $errors) . " bevatten.";
                }
            }
        
        $repeatNewPassword = testInput(getPostvar("new-password2"));
            if (empty($repeatNewPassword)) {
                $repeatNewPasswordErr = "Herhaal hier je nieuwe wachtwoord.";
            }
            else if ($newPassword != $repeatNewPassword) {
                $repeatNewPasswordErr = "Je wachtwoorden komen niet overeen.";
            }

        if (empty($oldPasswordError) && empty($newPasswordErr) && empty($repeatNewPasswordErr)){
            $user = authenticateUserByID(getLoggedInUserID(), $oldPassword);
            if (empty($user)) {
                $valid = false;
                $oldPasswordErr = "E-mailadres is niet bekend of wachtwoord wordt niet herkend.";
            } else {
                $valid = true;
            }
        }
    }

    return array ("oldPassword" => $oldPassword, "newPassword" => $newPassword, 
                    "repeatNewPassword" => $repeatNewPassword, "oldPasswordErr" => $oldPasswordErr, 
                    "newPasswordErr" => $newPasswordErr, "repeatNewPasswordErr" => $repeatNewPasswordErr,
                    "valid" => $valid); 
}

function validateDeliveryAddressSelection() {
    $deliveryAddressId = $deliveryAddressIdErr = "";
    $valid = false;

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $deliveryAddressId = testInput(getPostVar("deliveryAddressId"));
        if (empty($deliveryAddressId) && $deliveryAddressId != "0") {
            $deliveryAddressIdErr = "Kies een adres.";
        }
        
        if (empty($deliveryAddressIdErr)) {
            $valid = true;
        }
    }
    return array ("deliveryAddressId" => $deliveryAddressId, "deliveryAddressIdErr" => $deliveryAddressIdErr, "valid" => $valid);  
}

function validateDeliveryAddress($userId) {
    $address = $zipCode = $city = $phone = '';
    $addressErr = $zipCodeErr = $cityErr = $phoneErr = '';
    $valid = false;

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $address = testInput(getPostVar("address"));
        if (empty($address)) {
        $valid = false;
        $addressErr = "Vul een adres in.";
        }

        $zipCode = testInput(getPostVar("zip_code"));
        if (empty($zipCode)) {
            $valid = false;
            $zipCodeErr = "Vul een postcode in.";
        } else if (!preg_match("/^[0-9]{4}[A-Z]{2}$/",$zipCode)) {
            $zipCodeErr = "Vul je postcode in volgens dit formaat: 1234AB.";
        }

        $city = testInput(getPostVar("city"));
        if (empty($city)) {
            $valid = false;
            $cityErr = "Vul een woonplaats in.";
        } 

        $phone = testInput(getPostVar("phone"));
        if(empty($phone)) {
            $valid = false;
            $phoneErr = "Vul een telefoonnummer in.";
        } else if (!preg_match("/^0([0-9]{9})$/",$phone)) {
            $phoneErr = "Vul een geldig telefoonnummer in.";
        }
        
        if (empty($addressErr) && empty($zipCodeErr) && empty($cityErr) && empty($phoneErr)) {
            if(empty(findDeliveryAddressByUserAndAddress($userId, $address, $zipCode, $city))) {
                $valid = true;
            } else {
                $addressErr = "Dit adres bestaat al.";
            }
        }

    return array ("address" => $address, "zip_code" => $zipCode, "city" => $city, "phone" => $phone,
                    "addressErr" => $addressErr, "zipCodeErr" => $zipCodeErr, "cityErr" => $cityErr, 
                    "phoneErr" => $phoneErr, "valid" => $valid);
    }   
}
?>