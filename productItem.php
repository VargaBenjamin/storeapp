<?php

declare(strict_types=1);

require_once './product.php';

class ProductItem
{
    protected Product $product;
    protected int $quantity;

    public function __construct(Product $product, int $quantity)
    {
        $this->product = $product;
        $this->quantity = $quantity;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    public function getProduct() : Product
    {
        return $this->product;
    }

    public function printAll()
    {
        $this->product->printAll();
        echo 'quantity = ' . $this->quantity . '<br><br>';
    }
}
