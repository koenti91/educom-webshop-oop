<?php
require_once 'product_doc.php';

class DetailDoc extends ProductDoc {
    
    protected function showHeader() {
        echo 'Headwear';
    }

    protected function showContent() {
        $product = $this->model->product;
        echo '<div class="list">';
        $this ->showProductDetail($product);
        echo '</div>';  
    }

    private function showProductDetail() {
        echo '<h4 class ="detail-name">'.$this->model->product->name.'</h4>';
        echo '<img src="Images/'.$this->model->product->filename.'" alt="'.$this->model->product->name.'" width="170px">'; 
        echo '<p> €'.$this->model->product->price . '</p>';
        echo '<p>'.$this->model->product->description.'</p>';
        $this ->addActionForm("add-to-cart", "Toevoegen", "webshop", $this->model->product->id, true);
    }
}

?>