<?php
require_once "models/UserModel.php";
require_once "db_repository.php";
class ShopModel extends UserModel {

    public $products = array();
    public $product;
    public $cartRows = array();
    public $cartRow;
    public $productId;
    public $quantity;
    public $userId;
    public $deliveryAddressId;
    public $name;
    public $filename;
    public $total;
    public $deliveryAddress;
    public $canOrder = false;
    public $address = '';
    public $addressErr = '';
    public $zipCode = '';
    public $zipCodeErr = '';
    public $city = '';
    public $cityErr = '';
    public $phone = '';
    public $phoneErr = '';
    public $valid = false;

    public function __construct($pageModel) {
        PARENT::__construct($pageModel);

        $this->canOrder = $pageModel->sessionManager->isUserLoggedIn();
    }

    public function handleActionForm() {
        $this->model = NULL;
        $this->action = $this->getPostVar("action");
        switch ($this->action) {
            case "add-to-cart":
                $this->productId = $this->getPostVar("productId");
                $this->quantity = $this->getPostVar("quantity");
        
                $this->sessionManager->addToCart($this->productId, $this->quantity);
                break;
        
            case "delete":
                $this->productId = $this->getPostVar("productId");
                $this->sessionManager->deleteFromCart($this->productId);
                break;
            
            case "orderConfirmation":
                $this->userId = $this->sessionManager->getLoggedInUserID();
                $this->getShoppingCartRows();
                $this->deliveryAddressId = $this->getPostVar("deliveryAddressId", -1);
                $this->storeOrder($this->userId, $this->deliveryAddressId, $this->cartRows);
                break;
        }
    }

    public function getShoppingCartRows() {
        require_once("CartRow.php");
        try {
            $cart = $this->sessionManager->getShoppingCart();
            $this->products = getAllProducts();
    
            foreach ($cart as $productId => $quantity) {
                $product = $this->getArrayVar($this->products, $productId, null);
                if ($product == null) {
                    continue;
                }
                $cartRow = new CartRow($product, $quantity);
                $this->cartRows[$productId] = $cartRow;
                $this->total += $cartRow->subtotal(); // $total = $total + $subtotal;
            }
        } catch (Exception $exception) {
            $this->genericErr = "Excuses, op dit moment kunnen er geen producten worden weergegeven.";
            $this->logError("GetAllProducts failed" .$exception -> getMessage());
        }
    }

    public function storeOrder() {
        try {
        saveOrder($this->userId, $this->deliveryAddress, $this->cartRows);
        $this->sessionManager->emptyCart();
       } catch (Exception $exception) {
            $this->genericErr = 'Excuses, op dit moment lukt het niet om je bestelling te verwerken.';
            $this->logError("saveOrder failed" .$exception -> getMessage());
       }
    }

    public function getProductDetails() {
        $this->product = NULL;
        try {
            $this->productId = $this->getUrlVar('id');
            $this->product = findProductById($this->productId);
        } catch (Exception $exception) {
            $this->genericErr = "Excuses, op dit moment kunnen er geen producten worden weergegeven.";
            $this->logError("GetAllProducts failed" .$exception -> getMessage());
        }
    }

        // delivery address 
        public function getLoggedInUserData() {
            return $this->sessionManager->getLoggedInUserID();
        }
    
        public function validateDeliveryAddressSelection() {
        
            if ($this->isPost) {
        
                $this->deliveryAddressId = $this->testInput($this->getPostVar("deliveryAddressId"));
                if (empty($this->deliveryAddressId) && $this->deliveryAddressId != "0") {
                    $this->deliveryAddressIdErr = "Kies een adres.";
                }
                if (empty($this->deliveryAddressIdErr)) {
                    $this->valid = true;
                }
            }     
        }
    
        public function validateDeliveryAddress() {
        
            if ($this->isPost) {
        
                $this->address = $this->testInput($this->getPostVar("address"));
                if (empty($this->address)) {
                $this->valid = false;
                $this->addressErr = "Vul een adres in.";
                }
        
                $this->zipCode = $this->testInput($this->getPostVar("zip_code"));
                if (empty($this->zipCode)) {
                    $this->valid = false;
                    $this->zipCodeErr = "Vul een postcode in.";
                } else if (!preg_match("/^[0-9]{4}[A-Z]{2}$/",$this->zipCode)) {
                    $this->zipCodeErr = "Vul je postcode in volgens dit formaat: 1234AB.";
                }
        
                $this->city = $this->testInput($this->getPostVar("city"));
                if (empty($this->city)) {
                    $this->valid = false;
                    $this->cityErr = "Vul een woonplaats in.";
                } 
        
                $this->phone = $this->testInput($this->getPostVar("phone"));
                if(empty($this->phone)) {
                    $this->valid = false;
                    $this->phoneErr = "Vul een telefoonnummer in.";
                } else if (!preg_match("/^0([0-9]{9})$/",$this->phone)) {
                    $this->phoneErr = "Vul een geldig telefoonnummer in.";
                }
                
                if (empty($this->addressErr) && empty($this->zipCodeErr) && empty($this->cityErr) && empty($this->phoneErr)) {
                    $this->userId = $this->sessionManager->getLoggedInUserID();
                    if(empty(findDeliveryAddressByUserAndAddress($this->userId, $this->address, $this->zipCode, $this->city))) {
                        $this->valid = true;
                    } else {
                        $this->addressErr = "Dit adres bestaat al.";
                    }
                }
            }
        }
    
        public function getCurrentDeliveryAddress() {
            return findDeliveryAddresses($this->userId);
        }
    
        public function storeDeliveryAddress() {
            $this->deliveryAddressId = saveDeliveryAddress($this->userId, $this->address, $this->zipCode, $this->city, $this->phone);
        }
    
        public function getDeliveryAddressesData() { 
            try {
                $this->userId = $this->sessionManager->getLoggedInUserID();
                $this->addresses = $this->getCurrentDeliveryAddress();
                $this->user = findUserByID($this->userId);
            }
            catch (Exception $exception) {
                $this->genericErr = "Excuses, adressen kunnen niet worden opgehaald.";
                $this->logError("GetDeliveryAddressesData failed" .$exception -> getMessage());
            }
        }
    
        public function getLastCheckBeforeOrder() {
            $this->deliveryAddress = findDeliveryById($this->userId, $this->deliveryAddressId);
            $this->user = findUserById($this->userId);
            $this->getShoppingCartRows();
        }
}   
?>