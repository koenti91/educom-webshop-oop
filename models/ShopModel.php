<?php
require_once "models/PageModel.php";
require_once "db_repository.php";
class ShopModel extends PageModel {

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
}   
?>