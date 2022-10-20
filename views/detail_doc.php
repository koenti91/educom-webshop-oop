<?php
require_once 'product_doc.php';

class DetailDoc extends ProductDoc {
    
    protected function showHeader() {
        echo 'Headwear';
    }

    protected function showContent() {
        $product = $this->model['product'];
        echo '<div class="list">';
        $this ->showProductDetail($product);
        echo '</div>';  
    }

    private function showProductDetail($product) {
        echo '<h4 class ="detail-name">'.$product['name'].'</h4>';
        echo '<img src="Images/'.$product['filename'].'" alt="'.$product['name'].'" width="170px">'; 
        echo '<p> €'.$product['price'] . '</p>';
        echo '<p>'.$product['description'].'</p>';
        $this ->addActionForm("add-to-cart", "Toevoegen", "webshop", $product['id'], true);
    }
}

?>