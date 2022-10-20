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
    public $gender= '';
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

    function testInput() {
        $this->model = trim($this->model);
        $this->model = stripslashes($this->model);
        $this->model = htmlspecialchars($this->model);
        return $this->model;
    }

    public function validateLogin() {
        if ($this->isPost) {
            
            $email = testInput(getPostVar("email"));
            if (empty($email)) {
                $emailErr = "Vul je e-mailadres in.";
            }
    
            $password = testInput(getPostVar("password"));
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
        $this->SessionManager->doLoginUser($this->name, $this->userId);
        $this->genericErr= "Succesvol ingelogd!";
    }

    public function doLogoutUser() {
        //
    }
}
?>