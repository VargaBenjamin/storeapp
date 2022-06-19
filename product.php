<?php

declare(strict_types=1);

require_once './brand.php';

abstract class Product
{
    private static int $id = 0;
    protected int $productID;
    protected string $productName;
    protected int $price;
    protected Brand $brand;
    protected int $articleNumber;
    protected int $spaceRequirement;

    public function __construct(string $productName, int $price, Brand $brand, int $articleNumber, int $spaceRequirement)
    {
        $this->productName = $productName;
        $this->price = $price;
        $this->brand = $brand;
        $this->articleNumber = $articleNumber;
        $this->spaceRequirement = $spaceRequirement;
        $this->productID = self::$id;
        self::$id++;
    }

    public function getSpaceRequirement() : int
    {
        return $this->spaceRequirement;
    }

    public function printAll()
    {
        foreach ($this as $key => $value) {
            if ($key === 'brand') {
                $this->brand->printAll();
            } else {
                echo $key . ' = ' . $value . '<br>';
            }
        }
    }
}
