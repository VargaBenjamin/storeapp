<?php

declare(strict_types=1);

require_once './product.php';

class TV extends Product
{
    protected bool $smart;
    protected string $resolution;

    public function __construct(string $productName, int $price, Brand $brand, int $articleNumber, int $spaceRequirement, bool $smart, string $resolution)
    {
        parent::__construct($productName, $price, $brand, $articleNumber, $spaceRequirement);
        $this->smart = $smart;
        $this->resolution = $resolution;
    }
}
