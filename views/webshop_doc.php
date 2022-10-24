<?php
require_once 'product_doc.php';

class WebshopDoc extends ProductDoc {
    
    protected function showHeader() {
        echo 'Headwear';
    }

    protected function showContent () {
        echo' <div class="product-overview">';

        foreach ($this->model->products as $product) {
            $this->showWebshopProduct($product);
        }

        echo '</div>';
    }

    private function showWebshopProduct() {
        echo '<div class="product-list"><a class="shop-products" href="index.php?page=detail&id='.$this->product->id.'">';
        if (isset($this->model->product->name)) {
            echo '<h4>'.$this->model->product->name.'</h4>';
        }
        echo '<img src="Images/'.$this->model->product->filename.'" alt="'.$this->model->product->name.'" width="100px">';
        echo '<p> &euro;'.$this->product->price . '</p></a>';
        $this->model-> addActionForm("add-to-cart", "Toevoegen", "webshop", $this->model->product->id, true);
        echo '</div>';
    }
}

?>