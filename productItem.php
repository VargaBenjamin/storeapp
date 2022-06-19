<?php

declare(strict_types=1);

require_once './product.php';

class ProductItem
{
    protected Product $product;
    protected int $quantity;

    public function __construct(Product $product, int $quantity) {
        $this->product = $product;
        $this->quantity = $quantity;
    }

    public function printAll()
    {
        echo 'Termék: <br>';
        $this->product->printAll();
        echo 'quantity = ' . $this->quantity . '<br><br>';
    }
}
