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
    private $user = null;
    private $userId = 0;
    public $valid = false;

    public function __construct($pageModel) {
        PARENT::__construct($pageModel);
    }

    function testInput($string) {
        $string = trim($string);
        $string = stripslashes($string);
        $string = htmlspecialchars($string);
        return $string;
    }

    //login user
    public function validateLogin() {
        if ($this->isPost) {
            
            $this->email = testInput($this->getPostVar('email'));
            if (empty($this->email)) {
                $this->emailErr = "Vul je e-mailadres in.";
            }
    
            $this->password = testInput($this->getPostVar("password"));
            if (empty($this->password)) {
                $this->passwordErr = "Vul je gekozen wachtwoord in.";
            }
    
            if (empty($this->emailErr) && empty($this->passwordErr)) {
                $this->valid = true;
            }
    
            if ($this->valid) {
                $this->authenticateUser();
                if (empty($this->user)) {
                    $this->valid = false;
                    $this->genericErr = "E-mailadres is niet bekend of wachtwoord wordt niet herkend.";
                }
                else {
                    $this->email = $this->user["email"];
                    $this->name = $this->user["name"];
                    $this->userId = $this->user["id"];
                }
            }
        }
    }

    private function authenticateUser () {
            require_once "db_repository.php";
            $this->user = findUserbyEmail($this->email);
            return $this->authenticateUserByUser();
        }

    private function authenticateUserByUser() {
        if (empty($this->user)) {
            return;
        }
        var_dump($this->password, $this->user["password"]);
        if (!password_verify($this->password, $this->user["password"])) {
            var_dump("wrong password");
            $this->user = NULL;
        }
    }

    public function doLoginUser() {
        $this->sessionManager->loginUser($this->name, $this->userId);
        $this->genericErr= "Succesvol ingelogd!";
    }

    //logout user
    public function doLogoutUser() {
        $this->sessionManager->logoutUser($this->name, $this->userId);
        $this->genericErr= "Succesvol uitgelogd.";
    }

    //register new user
    public function validateRegister() {
        
        if($this->isPost) {
            $this->name = testInput($this->getPostvar("name"));
            if (empty($this->name)) {
                $this->nameErr = "Naam is verplicht";
            } 
            else if (!preg_match("/^[a-zA-Z' ]*$/",$this->name)) {
                $this->nameErr = "Alleen letters en spaties zijn toegestaan."; 
            }
            
            $this->email = testInput($this->getPostVar("email")); 
            if (empty($this->email)) {
                $this->emailErr = "E-mail is verplicht";
            }
            else if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
                    $this->emailErr = "Vul een correct e-mailadres in.";
            }
    
            $this->password = testInput($this->getPostvar("password"));
            if (empty($this->password)) {
                $this->passwordErr = "Vul hier een wachtwoord in.";
            }
            else {
                $errors = array();
                if (!preg_match('@[A-Z]@', $this->password)) { 
                    array_push($errors, "een hoofdletter");
                }
               
                if (!preg_match('@[a-z]@', $this->password)) {
                    array_push($errors, "een kleine letter");    
                }
                if (!preg_match('@[0-9]@', $this->password)) {
                    array_push($errors, "een cijfer");
                }
                if (!preg_match('@[^\w]@', $this->password)) {
                    array_push($errors, "een speciaal teken");
                }
                if (strlen($this->password) < 8) {
                    array_push($errors, "acht tekens");
                }
                if (!empty($errors)) {
                    $this->passwordErr = "Wachtwoord moet tenminste " . implode(", ", $errors) . " bevatten.";
                }
            }
    
            $this->passwordRepeat = testInput(getPostvar("password-repeat"));
            if (empty($this->passwordRepeat)) {
                $this->passwordRepeatErr = "Herhaal hier je gekozen wachtwoord.";
            }
            else if ($this->password != $this->passwordRepeat) {
                $this->passwordRepeatErr = "Je wachtwoorden komen niet overeen.";
            }
    
            if (empty($this->nameErr) && empty($this->emailErr) && empty($this->passwordErr) && empty($this->passwordRepeatErr)){
                if (empty(findUserByEmail($this->email))){
                    $this->valid = true;
                } else {
                    $this->emailErr = "E-mailadres is al in gebruik.";
                }
            }
        }
    }

    public function storeUser() {
        require_once "db_repository.php";
        $options = [12];
        $hashedPassword = password_hash ($this->password, PASSWORD_BCRYPT, $options);
        saveUser($this->name, $this->email, $hashedPassword);
    }
    
    // contact 
    public function validateContact() {
        if($this->isPost) {
            
            $this->gender = testInput($this->getPostVar("gender"));
            if (empty($this->gender)) { 
                $this->genderErr = "Aanhef is verplicht.";
            } else if (!array_key_exists($this->gender, GENDERS)) {
                $this->genderErr = "Aanhef is niet correct.";
            }
    
            $this->name = testInput($this->getPostVar("name"));
            if (empty($this->name)) {
                $this->nameErr = "Naam is verplicht";
            }
                else if (!preg_match("/^[a-zA-Z-' ]*$/",$this->name)) {
                $this->nameErr = "Alleen letters en spaties zijn toegestaan.";
            }
            
            $this->email = testInput($this->getPostVar("email"));
            if (empty($this->email)) {
                $this->emailErr = "E-mail is verplicht";
            } 
                else if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
                $this->emailErr = "Vul een correct e-mailadres in";
            }
            
            $this->phone = testInput($this->getPostVar("phone"));
            if (empty($this->phone)) {
                $this->phoneErr = "Telefoonnummer is verplicht";
            } 
                else if (!preg_match("/^0([0-9]{9})$/",$this->phone)) {
                $this->phoneErr = "Vul een geldig telefoonnummer in.";
            }
    
            $this->preferred = testInput($this->getPostVar("preferred"));
            if (!isset($this->preferred)) {  
                $this->preferredErr = "Vul een voorkeur in."; 
            } 
                else if (!array_key_exists($this->preferred, PREFERRED)) {
                $this->preferredErr = "Vul een voorkeur in.";  
            }
    
            $this->question = testInput($this->getPostVar("question"));    
            if (empty($this->question)) {
                $this->questionErr = " Vul hier je vraag of opmerking in.";
            }   
                else {
                $this->question = testInput($_POST["question"]);
            }  
    
            if (empty($this->genderErr) && empty($this->nameErr) && empty($this->emailErr) && 
                empty($this->phoneErr) && empty($this->preferredErr) && empty($this->questionErr))  {
           
                $this->valid = true;
            } 
         }
    }

    // change password
    public function validateChangePassword() {
        if($this->isPost) {

            $this->password = testInput($this->getPostvar("current-password"));
                if (empty($this->password)) {
                    $this->passwordErr = "Vul hier je oude wachtwoord in.";
                }
    
            $this->newPassword = testInput($this->getPostvar("new-password"));
                if (empty($this->newPassword)) {
                    $this->newPasswordErr = "Vul hier je nieuwe wachtwoord in.";
                }
                else {
                    $errors = array();
                    if (!preg_match('@[A-Z]@', $this->newPassword)) { 
                        array_push($errors, "een hoofdletter");
                    }
                   
                    if (!preg_match('@[a-z]@', $this->newPassword)) {
                        array_push($errors, "een kleine letter");    
                    }
                    if (!preg_match('@[0-9]@', $this->newPassword)) {
                        array_push($errors, "een cijfer");
                    }
                    if (!preg_match('@[^\w]@', $this->newPassword)) {
                        array_push($errors, "een speciaal teken");
                    }
                    if (strlen($this->newPassword) < 8) {
                        array_push($errors, "acht tekens");
                    }
                    if (!empty($errors)) {
                        $this->newPasswordErr = "Wachtwoord moet tenminste " . implode(", ", $errors) . " bevatten.";
                    }
                }
            
            $this->repeatNewPassword = testInput($this->getPostvar("new-password2"));
                if (empty($this->repeatNewPassword)) {
                    $this->repeatNewPasswordErr = "Herhaal hier je nieuwe wachtwoord.";
                }
                else if ($this->newPassword != $this->repeatNewPassword) {
                    $this->repeatNewPasswordErr = "Je wachtwoorden komen niet overeen.";
                }
    
            if (empty($this->passwordError) && empty($this->newPasswordErr) && empty($this->repeatNewPasswordErr)){
                $this->authenticateUserByID();
                if (empty($this->user)) {
                    $this->valid = false;
                    $this->passwordErr = "Wachtwoord wordt niet herkend.";
                } else {
                    $this->valid = true;
                }
            }
        }
    }

    private function authenticateUserByID() {
        require_once "db_repository.php";
        $this->user = findUserByID($this->sessionManager->getLoggedInUserID());
        var_dump($this->user);
        $this->authenticateUserByUser();
    }

    public function storeNewPassword() {
        require_once "db_repository.php";
        $options = [12];
        $hashedPassword = password_hash ($this->newPassword, PASSWORD_BCRYPT, $options);
        changePassword($this->userId, $hashedPassword);
    }
}
?>
