<?php

declare(strict_types=1);

require_once './product.php';

class Book extends Product
{
    protected string $author;
    protected string $title;

    public function __construct(string $productName, int $price, Brand $brand, int $articleNumber, int $spaceRequirement, string $author, string $title)
    {
        parent::__construct($productName, $price, $brand, $articleNumber, $spaceRequirement);
        $this->author = $author;
        $this->title = $title;
    }
}
