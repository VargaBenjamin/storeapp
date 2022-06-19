<?php 
declare(strict_types=1);

require_once './product.php';

class Car extends Product
{
    protected int $doors;
    protected string $color;
    
    public function __construct(string $productName, int $price, Brand $brand, int $articleNumber, int $spaceRequirement, int $doors, string $color) {
        parent::__construct($productName, $price, $brand, $articleNumber, $spaceRequirement);
        $this->doors = $doors;
        $this->color = $color;
    }
}
