<?php
require_once 'product_doc.php';

class WebshopDoc extends ProductDoc {
    
    protected function showHeader() {
        echo 'Headwear';
    }

    protected function showContent () {
        $products = $this->model['products'];
        echo' <div class="product-overview">';

        foreach ($products as $product) {
            $this-> showWebshopProduct($product);
        }

        echo '</div>';
    }

    private function showWebshopProduct($product) {
        echo '<div class="product-list"><a class="shop-products" href="index.php?page=detail&id='.$product['id'].'">';
        if (isset($product['name'])) {
            echo '<h4>'.$product['name'].'</h4>';
        }
        echo '<img src="Images/'.$product['filename'].'" alt="'.$product['name'].'" width="100px">';
        echo '<p> &euro;'.$product['price'] . '</p></a>';
        $this -> addActionForm("add-to-cart", "Toevoegen", "webshop", $product['id'], true);
        echo '</div>';
    }
}

?>