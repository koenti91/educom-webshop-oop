<?php

require_once ("shopping_cart.php");

function showWebshopHeader() {
    echo 'Headwear';
}

function showWebshopContent($data) {
    echo' <div class="product-overview">';
    
    foreach($data['products'] as $product) {
        showWebshopProduct($product);
    }

    echo '</div>';
}

function showWebshopProduct($product) {
    echo '<div class="product-list"><a class="shop-products" href="index.php?page=detail&id='.$product['id'].'">';
    echo '<h4>'.$product['name'].'</h4>';
    echo '<img src="Images/'.$product['filename'].'" alt="'.$product['name'].'" width="100px">';
    echo '<p> &euro;'.$product['price'] . '</p></a>';
    addActionForm("add-to-cart", "Toevoegen aan mandje", "webshop", $product['id'], true);
    echo '</div>';
}

?>