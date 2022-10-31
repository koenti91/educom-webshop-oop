<?php

class CartRow {
    public $product;
    public $quantity;

    public function __construct($product, $quantity) {
        $this->product = $product;
        $this->quantity = $quantity;
    }

    public function priceInCents() {
        return intVal($this->product->price * 100); 
    }

    public function subTotal() {
        return $this->priceInCents() * $this->quantity;
    }

    public function name() {
        return $this->product->name;
    }

    public function filename() {
        return $this->product->filename;
    }

    public function productId() {
        return $this->product->id;
    }

    public function quantity() {
        return $this->quantity;
    }
}