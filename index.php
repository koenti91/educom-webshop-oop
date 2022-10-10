<?php

session_start();

require_once ("constants.php");
require_once ("session_manager.php");
require_once ("validations.php");
require_once ("products_service.php");

// Main
$page = getRequestedPage();
$data = processRequest($page);

var_dump($data);
showResponsePage($data);
// Functions

function logError($msg) {
    echo "LOG TO SERVER: " . $msg;
}

function processRequest($page) {
    switch ($page) {
        case "login":
            $data = validateLogin();
            if ($data['valid']) {
                doLoginUser($data['name'], $data['userId']);
                $page = 'home';
            }
            break;

        case 'logout':
            doLogoutUser();
            $page = 'home';
            break;

        case 'contact':
            $data = validateContact();
            if($data['valid']) {
                $page = 'thanks';
            }
            break;
            
        case 'register':
            $data = validateRegister();
            if ($data['valid']) {
                storeUser($data["name"], $data["email"], $data["password"]);
                $page = 'login';
            }
            break;

        case 'changepw':
            $data = validateChangePassword();
            if ($data['valid']) {
                storeNewPassword(getLoggedInUserId(), $data["newPassword"]);
                $page = 'changePwConfirmation';
            }
            break;
    
        case 'webshop':
            handleActionForm();
            $data = getWebshopProducts();
            break;

        case 'detail':
            handleActionForm();
            $id = getUrlVar("id");
            $data = getProductDetails($id);
            break;

        case 'shoppingCart':
            handleActionForm();
            $data = getShoppingCartRows();
            break;

        case 'deliveryAddress':
            require_once('delivery_address.php');
            $data = validateDeliveryAddressSelection();
            $userId = getLoggedInUserID();
            if ($data['valid']) {
                if ($data['deliveryAddressId'] == 0) {
                    $page = 'newDeliveryAddress';
                } else {
                    $page = "lastCheck";
                    $data = array_merge($data, findDeliveryById($userId, $data['deliveryAddressId']));
                    $data["user"] = findUserByID($userId);
                    $data = array_merge($data, getShoppingCartRows());
                }
            }
            else {
                $data = array_merge($data, getDeliveryAddressesData($userId));
            }
            break;

        case 'newDeliveryAddress':
            $userId = getLoggedInUserID();
            $data = validateDeliveryAddress($userId);
            if($data['valid']) {
                $data["deliveryAddressId"] = storeDeliveryAddress($userId, $data);
                $data["user"] = findUserByID($userId);
                $data = array_merge($data, getShoppingCartRows());
                $page = 'lastCheck';
            }
            break;

        case 'orderConfirmation':
            require_once ('last_check.php');
            $data = handleActionForm();
            break;    
    }

    $data['page'] = $page;
    $data['menu'] = array ('home' => 'Home', 'about' => 'About', 'contact' => 'Contact', 
                    'webshop' => 'Shop Headwear');
    if(isUserLoggedIn()) {
        $data['menu'] ['shoppingCart'] = 'Winkelmand';
        $data['menu'] ['logout'] = 'Logout ' . getLoggedInUsername();
        $data['menu'] ['changepw'] = 'Verander wachtwoord';
    } else {
        $data['menu'] ['login'] = 'Login';
        $data['menu'] ['register'] = 'Registreren';
    }
    return $data;
}

function showContent($data) {
    echo '<div class="error">'.getArrayVar($data, "genericErr").'</div>';
    switch ($data['page']) {
        case 'home':
            showHomeContent($data);
            break;

        case 'about':
            showAboutContent($data);
            break;

        case 'contact':
            showContactForm($data);
            break;

        case 'thanks':
            showContactThanks($data);
            break;

        case 'login':
            showLoginForm($data);
            break;

        case 'register':
            showRegisterForm($data);
            break;

        case'changepw':
            showChangePwForm($data);
            break;
            
        case 'changePwConfirmation':
            showChangePwConfirmationMessage($data);
            break;

        case 'webshop':
            showWebshopContent($data);
            break;

        case 'detail':
            require_once('detail.php');
            showDetailContent($data);
            break;

        case 'shoppingCart':
            require_once('shopping_cart.php');
            showShoppingCart($data);
            break;
       
        case 'deliveryAddress':
            require_once('delivery_address.php');
            chooseDeliveryAddress($data);
            break;

        case 'newDeliveryAddress':
            addNewDeliveryAddress($data);
            break;
        
        case 'lastCheck':
            require_once('last_check.php');
            showLastCheckContent($data);
            break;

        case 'orderConfirmation':
            require_once('order_confirmation.php');
            showOrderConfirmation($data);
            break;
    }
}

function getRequestedPage()
{
    $requested_type = $_SERVER['REQUEST_METHOD'];
    if ($requested_type == 'POST') 
    {
        $requested_page = getPostVar('page','home');
    }
    else
    {
        $requested_page = getUrlVar('page','home');
    }
    return $requested_page;
}

function showResponsePage($data) {
    
    beginDocument();
    showHeadSection($data);
    showBodySection($data);
    endDocument();
}

function getArrayVar($array, $key, $default ='')
{
    return isset($array[$key]) ? $array[$key] : $default;
}

function getPostVar($key, $default ='')
    {    
    return getArrayVar($_POST, $key, $default);
}

function getUrlVar($key, $default = '')
{
    return getArrayVar($_GET, $key, $default);
}

function beginDocument()
{
    echo '<!doctype html>
    <html>';
}

function showHeadSection($data)
{
    echo '<head> <title>';
    switch ($data['page'])
    {
        case 'home':
            require_once('home.php');
            showHomeHeader();
            break;
        case 'about':
            require_once('about.php');
            showAboutHeader();
            break;
        case 'contact':
            require_once('contact.php');
            showContactHeader();
            break;
        case 'register':
            require_once('register.php');
            showRegisterHeader();
            break;
        case 'login':
            require_once('login.php');
            showLoginHeader();
            break;
        case 'changepw':
        case 'changePwConfirmation':
            require_once('changepw.php');
            showChangePwHeader();
            break;
        case 'webshop':
        case 'detail':
            require_once('webshop.php');
            showWebshopHeader();
            break;
        case 'shoppingCart':
            require_once('shopping_cart.php');
            showShoppingCartHeader();
            break;
        case 'deliveryAddress':
        case 'newDeliveryAddress':
            require_once('delivery_address.php');
            showDeliveryAddressHeader();
            break;
        case 'orderConfirmation':
            require_once('order_confirmation.php');
            showOrderConfirmationHeader();
            break;
        case 'lastCheck':
            require_once('last_check.php');
            showLastCheckHeader();
            break;

        default:
            echo 'Error: Page NOT found';
    }
    echo '</title> <link rel="stylesheet" href="css/stylesheet.css"> </head>';
}

function showBodySection($data)
{
    echo '<body>';
    showHeader($data);
    showMenu($data);
    showContent($data);
    showFooter();
    echo '</body>';
}

function showHeader($data) {   
    echo ' <header>';
    switch ($data['page'])
    {
        case 'home':
            require_once('home.php');
            showHomeHeader();
            break;
        case 'about':
            require_once('about.php');
            showAboutHeader();
            break;
        case 'contact':
            require_once('contact.php');
            showContactHeader();
            break;
        case 'register':
            require_once('register.php');
            showRegisterHeader();
            break;
        case 'login':
            require_once('login.php');
            showLoginHeader();
            break;
        case 'changepw':
        case 'changePwConfirmation':
            require_once('changepw.php');
            showChangePwHeader();
            break;
        case 'webshop':
        case 'detail':
            require_once('webshop.php');
            showWebshopHeader();
            break;
        case 'shoppingCart':
            require_once('shopping_cart.php');
            showShoppingCartHeader();
            break;
        case 'deliveryAddress':
        case 'newDeliveryAddress':
            require_once('delivery_address.php');
            showDeliveryAddressHeader();
            break;
        case 'orderConfirmation':
            require_once('order_confirmation.php');
            showOrderConfirmationHeader();
            break;
        case 'lastCheck':
            require_once('last_check.php');
            showLastCheckHeader();
            break;
        default:
            echo 'Error: Page not found';
    }
    echo '</header>';
}

function showMenu($data) {
    echo '<div class="menu"><ul class="nav-tabs">';
    foreach($data['menu'] as $link => $label) {
        echo showMenuItem($link, $label);
    }
    echo '</ul></div>';
}

function showMenuItem($page, $label) {
    return '<li><a href="index.php?page='.$page.'">'.$label.'</a></li>';
}

function showFooter()
{
    echo '<footer>';
    echo '<p class="copyright">&copy; 2022 Koen Tiepel</p>';
    echo '</footer>';
}

function endDocument()
{
    echo '</html>';
}

 function addActionForm($action, $buttonLabel, $nextPage, $productId = null, $showQuantity = false) {
    if (!isUserLoggedIn()) {
        return;
    }
    echo '<form method="post" action="index.php">';
    if ($showQuantity) {
        $cart = getShoppingCart();
        $currentValue = getArrayVar($cart, $productId, 1);
        echo '<input type="text" name="quantity" class="set-quantity" value="'.$currentValue.'" />';
    }
    if ($productId != null) {
        echo '<input type="hidden" name="product-id" value="'.$productId.'">';
    }
    echo '<input type="hidden" name="action" value="' . $action .'">';  
    echo '<input type="hidden" name="page" value="'. $nextPage .'">';  
    echo '<input type="submit" name="submit" class="btn-btn" value= "'.$buttonLabel.'">';
    echo '</form>';
 }
?>