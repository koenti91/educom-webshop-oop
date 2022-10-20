<?php
require_once "models/PageModel.php";

class PageController {

    private $model;

    public function __construct() {
        $this->model = new PageModel(NULL);
    }

    public function handleRequest() {
        $this->getRequest();
        //$this->processRequest();
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
                $this->model = new UserModel($this->model);
                $model -> validateLogin();
                if($model->valid) {
                    $this->model->doLoginUser();
                    $this->model->setPage("home");
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
        }
        $view->show();
    }
}

?>