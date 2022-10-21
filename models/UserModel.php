<?php 

class UserModel extends PageModel {
    
    public $email = '';
    public $emailErr = '';
    public $name = '';
    public $nameErr = '';
    public $password = ''; 
    public $passwordErr = '';
    public $passwordRepeat = '';
    public $passwordRepeatErr = '';
    public $gender = '';
    public $genderErr = '';
    public $phone= '';
    public $phoneErr = '';
    public $preferred = '';
    public $preferredErr = '';
    public $question= '';
    public $questionErr = '';
    public $oldPassword = '';
    public $oldPasswordErr = '';
    public $newPassword = '';
    public $newPasswordErr = '';
    public $repeatNewPassword = '';
    public $repeatNewPasswordErr = '';
    private $userId = 0;
    public $valid = false;

    public function __construct($pageModel) {
        PARENT::__construct($pageModel);
    }

    function testInput($model) {
        $model = trim($model);
        $model = stripslashes($model);
        $model = htmlspecialchars($model);
        return $model;
    }

    //login user
    public function validateLogin() {
        if ($this->isPost) {
            
            $email = testInput($this->getPostVar('email'));
            if (empty($email)) {
                $emailErr = "Vul je e-mailadres in.";
            }
    
            $password = testInput($this->getPostVar("password"));
            if (empty($password)) {
                $passwordErr = "Vul je gekozen wachtwoord in.";
            }
    
            if (empty($emailErr) && empty($passwordErr)) {
                $this->valid = true;
            }
    
            if ($this->valid) {
                $this->user = authenticateUser ($email, $password);
                if (empty($this->user)) {
                    $valid = false;
                    $emailErr = "E-mailadres is niet bekend of wachtwoord wordt niet herkend.";
                } else {
                    $email = $this->user->email;
                    $name = $this->user->name;
                    $userId = $this->user->id;
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

    private function authenticateUser () {
            require_once "db_repository.php";
            $user = findUserbyEmail($this->email);
            return authenticateUserByUser($this->user, $this->password);
        }

    public function doLoginUser() {
        $this->SessionManager->loginUser($this->name, $this->userId);
        $this->genericErr= "Succesvol ingelogd!";
    }

    //logout user
    public function doLogoutUser() {
        $this->SessionManager->logoutUser($this->name, $this->userId);
        $this->genericErr= "Succesvol uitgelogd.";
    }

    //register new user
    public function validateRegister() {
        
        if($this->isPost) {
            $name = testInput($this->getPostvar("name"));
            if (empty($name)) {
                $nameErr = "Naam is verplicht";
            } 
            else if (!preg_match("/^[a-zA-Z' ]*$/",$name)) {
                $nameErr = "Alleen letters en spaties zijn toegestaan."; 
            }
            
            $email = testInput($this->getPostVar("email")); 
            if (empty($email)) {
                $emailErr = "E-mail is verplicht";
            }
            else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $emailErr = "Vul een correct e-mailadres in.";
            }
    
            $password = testInput($this->getPostvar("password"));
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
}
?>
