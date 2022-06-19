<?php

declare(strict_types=1);

require_once './productItem.php';
require_once './storageDirector.php';

class Storage
{
    private static int $id = 0;
    protected int $storageID;
    protected string $storageName;
    protected int $capacity;
    protected array $stock = [];

    public function __construct(string $storageName, int $capacity)
    {
        $this->storageName = $storageName;
        $this->capacity = $capacity;
        $this->storageID = self::$id;
        self::$id++;
        StorageDirector::addStorage($this);
    }

    public function printAll()
    {
        echo 'Raktár név = ' . $this->storageName . '<br>';
        array_map('self::printProduct', $this->stock);
        echo '<br>';
    }

    private function printProduct(ProductItem $item)
    {
        $item->printAll();
    }

    public function addProduct(ProductItem $item): ProductItem | null
    {
        if ($this->capacity > 0) {
            $quantity = $item->getQuantity();
            $space = $item->getProduct()->getSpaceRequirement();
            $fitPieces = intdiv($this->capacity, $space);
            if ($fitPieces > 0) {
                if ($fitPieces >= $quantity) {
                    array_push($this->stock, $item);
                    $this->capacity -= $space * $quantity;
                    return null;
                } else {
                    $leftoverPieces = $quantity - $fitPieces;
                    $clonedItem = clone ($item);
                    $clonedItem->setQuantity($fitPieces);
                    array_push($this->stock, $clonedItem);
                    $item->setQuantity($leftoverPieces);
                    $this->capacity -= $space * $fitPieces;
                    return $item;
                }
            } else {
                return $item;
            }
        } else {
            return $item;
        }
    }
}
