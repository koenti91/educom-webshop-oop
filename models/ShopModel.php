<?php

class ShopModel extends PageModel {

    public $products = array();
    public $product = '';
    public $productId = null;
    public $cartRows = array();
    public $cartRow = '';
    public $name = '';
    public $id = '';
    public $filename = '';
    public $price = '';
    public $quantity = '';
    public $description = '';
    public $canOrder = false;
    public $canEdit = false;
    public $action = '';
    public $user = '';
    public $email = '';
    public $phone = '';
    public $address = '';
    public $zipCode = '';
    public $city = '';
    public $deliveryAddress = '';
    public $deliveryAddressId = '';
    public $addresses = '';
    public $genericErr = '';
    public $total = '';
    public $cart = '';
    public $priceInCents = '';
    public $subtotal = '';
    public $userId = '';
    public $buttonLabel = '';
    public $nextPage = '';
    public $showQuantity = false;
    public $currentValue = '';

    public function __construct($pageModel) {
        PARENT::__construct($pageModel);
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
                $this->model = $this->getShoppingCartRows();
                $this->deliveryAddressId = $this->getPostVar("deliveryAddressId", -1);
                $this->model = $this->storeOrder($this->userId, $this->deliveryAddressId, $this->cartRows);
                break;
        }
    }

    public function getShoppingCartRows() {
        try {
            $this->cart = $this->sessionManager->getShoppingCart();
            $this->products = getAllProducts();
    
            foreach ($this->cart as $this->productId => $this->quantity) {
                $this->product = getArrayVar($this->products, $this->productId, null);
                if ($this->product == null) {
                    continue;
                }
                $this->priceInCents = intVal($this->product->price * 100); 
                $this->subtotal = $this->priceInCents * $this->quantity;
                $this->cartRow = array($this->productId, $this->quantity, $this->subtotal, 
                                  $this->priceInCents, $this->product->name, $this->product->filename);
                $this->cartRows[] = $this->cartRow;
                $this->total += $this->subtotal; // $total = $total + $subtotal;
            }
        } catch (Exception $exception) {
            $this->genericErr = "Excuses, op dit moment kunnen er geen producten worden weergegeven.";
            logError("GetAllProducts failed" .$exception -> getMessage());
        }
    }

    public function storeOrder() {
        try {
        saveOrder($this->userId, $this->deliveryAddress, $this->cartRows);
        $this->sessionManager->emptyCart();
       } catch (Exception $exception) {
            $this->genericErr = 'Excuses, op dit moment lukt het niet om je bestelling te verwerken.';
            logError("saveOrder failed" .$exception -> getMessage());
       }
    }

    public function addActionForm() {
        if (!$this->sessionManager->isUserLoggedIn()) {
            return;
        }
        echo '<form method="post" action="index.php">';
        if ($this->showQuantity) {
            $this->cart = $this->sessionManager->getShoppingCart();
            $this->currentValue = getArrayVar($this->cart, $this->productId, 1);
            echo '<input type="text" name="quantity" class="set-quantity" value="'.$this->currentValue.'" />';
        }
        if ($this->productId != null) {
            echo '<input type="hidden" name="product-id" value="'.$this->productId.'">';
        }
        echo '<input type="hidden" name="action" value="' . $this->action .'">';  
        echo '<input type="hidden" name="page" value="'. $this->nextPage .'">';  
        echo '<input type="submit" name="submit" class="btn-btn" value= "'.$this->buttonLabel.'">';
        echo '</form>';
    }

    public function getProductDetails() {
        $this->product = NULL;
        try {
            $this->product = findProductById($this->productId);
        } catch (Exception $exception) {
            $this->genericErr = "Excuses, op dit moment kunnen er geen producten worden weergegeven.";
            logError("GetAllProducts failed" .$exception -> getMessage());
        }
    }
}   
// string(9) "Geert123." string(60) "$2y$10$hjU1RaUw5qsgq2yztzLB5.iRtXBV0/z2sYWZ4JRlGOnIigNKiWvJm" 
// string(9) "Geert123." string(60) "$2y$10$hjU1RaUw5qsgq2yztzLB5.iRtXBV0/z2sYWZ4JRlGOnIigNKiWvJm" 
?>