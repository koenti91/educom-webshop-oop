<?php
require_once "./models/PageModel.php";

class PageController {

    private $model;

    public function __construct($pageModel) {
        $this->model = $pageModel;
    }

    public function handleRequest() {
        $this->getRequest();
        $this->processRequest();
        $this->showResponsePage();
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
                require_once "crud/UserCrud.php";
                $userCrud = new UserCrud($this->model->crud);
                $this->model = new UserModel($this->model, $userCrud);
                $this->model -> validateLogin();
                if($this->model->valid) {
                    $this->model->doLoginUser();
                    $this->model->setPage("home");
                }
                break;

            case "logout":
                require_once "models/UserModel.php";
                $this->model = new UserModel($this->model, null);
                $this->model -> doLogoutUser();
                $this->model -> setPage("home");
                break;

            case "contact":
                require_once "models/UserModel.php";
                $this->model = new UserModel($this->model, null);
                $this->model -> validateContact();
                if($this->model->valid) {
                    $this->model->setPage("thanks");
                }
                break;
                
            case "register":
                require_once "models/UserModel.php";
                require_once "crud/UserCrud.php";
                $userCrud = new UserCrud($this->model->crud);
                $this->model = new UserModel($this->model, $userCrud);
                $this->model -> validateRegister();
                if($this->model->valid) {
                    $this->model->storeUser();
                    $this->model->setPage("login");
                }
                break;

            case "changepw":
                require_once "models/UserModel.php";
                require_once "crud/UserCrud.php";
                $userCrud = new UserCrud($this->model->crud);
                $this->model = new UserModel($this->model, $userCrud);
                $this->model -> validateChangePassword();
                if($this->model->valid) {
                    $this->model->storeNewPassword();
                    $this->model->setPage("changePwConfirmation");
                }
                break;

            case 'webshop':
                require_once "models/ShopModel.php";
                require_once "crud/ShopCrud.php";
                $shopCrud = new ShopCrud($this->model->crud);
                $this->model = new ShopModel($this->model, $shopCrud);
                $this->model->handleActionForm();
                $this->model->getShoppingCartRows();
                break;

            case "detail":
                require_once "models/ShopModel.php";
                require_once "crud/ShopCrud.php";
                $shopCrud = new ShopCrud($this->model->crud);
                $this->model = new ShopModel($this->model, $shopCrud);
                $this->model->handleActionForm();
                $this->model->getShoppingCartRows();
                $this->model->getProductDetails();
                break;

            case "shoppingCart":
                require_once "models/ShopModel.php";
                require_once "crud/ShopCrud.php";
                $shopCrud = new ShopCrud($this->model->crud);
                $this->model = new ShopModel($this->model, $shopCrud);
                $this->model ->handleActionForm();
                $this->model->getShoppingCartRows();
                break;

            case "deliveryAddress":
                require_once 'models/ShopModel.php';
                require_once "crud/ShopCrud.php";
                $shopCrud = new ShopCrud($this->model->crud);
                $this->model = new ShopModel($this->model, $shopCrud);
                $this->model->validateDeliveryAddressSelection();
                if($this->model->valid) {
                    if ($this->model->deliveryAddressId == 0) {
                        $this->model->setPage("newDeliveryAddress");
                    } else {
                        $this->model->getLastCheckBeforeOrder();
                        $this->model->setPage("lastCheck"); 
                    }
                } else {
                    $this->model->getDeliveryAddressesData();
                }
                break;

            case "newDeliveryAddress":
                require_once "models/ShopModel.php";
                require_once "crud/ShopCrud.php";
                require_once 
                $shopCrud = new ShopCrud($this->model->crud);
                $this->model = new ShopModel($this->model, $shopCrud);
                $this->model->validateDeliveryAddress();
                if ($this->model->valid){
                    $this->model->storeDeliveryAddress();
                    $this->model->getLastCheckBeforeOrder();
                    $this->model->setPage("lastCheck");
                } 
                break;

            case "lastCheck":
                require_once "models/ShopModel.php";
                require_once "crud/ShopCrud.php";
                $shopCrud = new ShopCrud($this->model->crud);
                $this->model = new ShopModel($this->model, $shopCrud);
                $this->model->getLastCheckBeforeOrder();
                $this->model->storeOrder();
                $this->model->setPage("orderConfirmation");
                break;
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
            case "webshop":
                require_once ("views/webshop_doc.php");
                $view = new WebshopDoc($this->model);
                break;
            case "detail":
                require_once ("views/detail_doc.php");
                $view = new DetailDoc($this->model);
                break;
            case "shoppingCart":
                require_once ("views/shopping_cart_doc.php");
                $view = new ShoppingCartDoc($this->model);
                break;
            case "deliveryAddress":
                require_once ("views/delivery_address_doc.php");
                $view = new DeliveryAddressDoc($this->model);
                break;
            case "newDeliveryAddress":
                require_once ("views/new_delivery_address_doc.php");
                $view = new NewDeliveryAddressDoc($this->model);
                break;
            case "lastCheck":
                require_once("views/last_check_doc.php");
                $view = new LastCheckDoc($this->model);
                var_dump($this->model);
                break;
            case "orderConfirmation":
                require_once("views/order_confirmation_doc.php");
                $view = new OrderConfirmationDoc($this->model);
                break;
        }
        $view->show();
    }
}
