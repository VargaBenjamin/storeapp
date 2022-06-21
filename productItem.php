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

    public function setQuantity(int $quantity): void
    {
        if (!is_integer($quantity)) {
            throw new Exception('Helytelen beviteli érték.', 1);
        }
        $this->quantity = $quantity;
    }

    public function getProduct(): Product
    {
        return $this->product;
    }

    public function printAll(): void
    {
        $this->product->printAll();
        echo 'quantity = ' . $this->quantity . '<br><br>';
    }
}
