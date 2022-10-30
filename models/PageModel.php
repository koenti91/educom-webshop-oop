<?php
require_once "MenuItem.php";
require_once "SessionManager.php";

class PageModel {
    
    public $page;
    protected $isPost = false;
    public $menu;
    public $errors = array();
    public $genericErr = '';
    protected SessionManager $sessionManager;
    //

    public function __construct($copy) {
        if (empty($copy)) {
            // ==> First instance of PageModel
            $this->sessionManager = new SessionManager();
        } else {
            //==> Called from the constructor of an extended class
            $this->page = $copy->page;
            $this->isPost = $copy->isPost;
            $this->menu = $copy->menu;
            $this->genericErr = $copy->genericErr;
            $this->sessionManager = $copy->sessionManager;
        }
    }

    public function getRequestedPage() {

        $this -> isPost = ($_SERVER['REQUEST_METHOD'] == 'POST');

        if ($this->isPost) {
            $this->setPage($this->getPostVar("page", "home"));
        } else {
            $this->setPage($this->getUrlVar("page", "home"));
        }
    }

    public function setPage($newPage) {
        $this->page = $newPage;
    }

    protected function getUrlVar($key, $default ='') {
        return $this->getArrayVar($_GET, $key, $default);
    }

    protected function getPostVar($key, $default ='') {
        return $this->getArrayVar($_POST, $key, $default);
    }

    public function getArrayVar($array, $key, $default ='')
    {
        return isset($array[$key]) ? $array[$key] : $default;
    }

    public function createMenu() {
        $this->menu["home"] = new MenuItem('home', 'Home');
        $this->menu["about"] = new MenuItem('about', 'Over mij');
        $this->menu["contact"] = new MenuItem('contact', 'Contact');
        $this->menu["webshop"]  = new MenuItem('webshop', 'Webshop');
        if ($this->sessionManager->isUserLoggedIn()) {
            $this->menu["shoppingCart"] = new MenuItem('shoppingCart', 'Winkelmandje');
            $this->menu["logout"]  = new MenuItem('logout', 'Uitloggen',
                $this->sessionManager->getLoggedInUsername());
            $this->menu["changepw"]  = new MenuItem('changepw', 'Wachtwoord veranderen');
        } else {
            $this->menu["login"] = new MenuItem('login', 'Login');
            $this->menu["register"]  = new MenuItem('register', 'Registreren');
        }
    }

    protected function logError($msg) {
        echo "LOG TO SERVER: " . $msg;
    }  
}
?>