<?php
require_once "models/PageModel.php";

class PageController {

    private $model;

    public function __construct() {
        $this->model = new PageModel(NULL);
    }

    public function handleRequest() {
        $this->getRequest();
        $this->processRequest();
        $this->showResponsePage();
        print_r($this->model);
    }

    // from client
    private function getRequest() {
        $this->model->getRequestedPage();
    }

    //business flow code
    private function processRequest() {
        switch ($this->model->page) {
            case "login":
                require_once "models/UserModel.php";
                $this->model = new UserModel($this->model);
                $this->model -> validateLogin();
                if($this->model->valid) {
                    $this->model->doLoginUser();
                    $this->model->setPage("home");
                }
                break;
            case "logout":
                require_once "models/UserModel.php";
                $this->model = new UserModel($this->model);
                $this->model -> doLogoutUser();
                $this->model -> setPage("home");
                break;
            case "contact":
                require_once "models/UserModel.php";
                $this->model = new UserModel($this->model);
                $this->model -> validateContact();
                if($this->model->valid) {
                    $this->model->setPage("thanks");
                }
                break;
            case "register":
                require_once "models/UserModel.php";
                $this->model = new UserModel($this->model);
                $this->model -> validateRegister();
                if($this->model->valid) {
                    $this->model->storeUser();
                    $this->model->setPage("login");
                }
                break;
             case "changepw":
                require_once "models/UserModel.php";
                $this->model = new UserModel($this->model);
                $this->model -> validateChangePassword();
                if($this->model->valid) {
                    $this->model->storeNewPassword();
                    $this->model->setPage("changePwConfirmation");
                }
                break;
            //
        }
    }

    // to client: presentatielaag
    private function showResponsePage() {
        $this->model->createMenu();

        switch ($this->model->page) {
            case "home":
                require_once ("views/home_doc.php");
                $view = new HomeDoc($this->model);
                break;
            case "about":
                require_once ("views/about_doc.php");
                $view = new AboutDoc($this->model);
                break;
            case "contact":
                require_once ("views/contact_doc.php");
                $view = new ContactDoc($this->model);
                break;
            case "thanks":
                require_once ("views/contact_thanks_doc.php");
                $view = new ContactThanksDoc($this->model);
                break;
            case "register":
                require_once ("views/register_doc.php");
                $view = new RegisterDoc($this->model);
                break;
            case "login":
                require_once ("views/login_doc.php");
                $view  = new LoginDoc($this->model);
                break;
            case "changepw":
                require_once ("views/change_pw_doc.php");
                $view = new ChangePwDoc($this->model);
                break;
            case "changePwConfirmation";
                require_once ("views/change_pw_confirm_doc.php");
                $view = new ChangePwConfirmDoc($this->model);
                break;
            //
        }
        $view->show();
    }
}

?>