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

    public function printAll(): void
    {
        echo '-------------<br>';
        echo 'Raktár név = ' . $this->storageName . '<br>';
        array_map('self::printProduct', $this->stock);
    }

    private function printProduct(ProductItem $item): void
    {
        $item->printAll();
    }

    public function addProduct(ProductItem $item): ProductItem | null
    {
        if (empty($item)) {
            throw new Exception('Helytelen beviteli érték.', 1);
        }
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

    public function removeProduct(ProductItem $item): ProductItem | null
    {
        if (empty($item)) {
            throw new Exception('Helytelen beviteli érték.', 1);
        }
        for ($i = 0; $i < count($this->stock); $i++) {
            if ($this->stock[$i]->getProduct()->getProductName() === $item->getProduct()->getProductName()) {
                $stockItemQuantity = $this->stock[$i]->getQuantity();
                $itemQuantity = $item->getQuantity();
                if ($stockItemQuantity > $itemQuantity) {
                    $this->stock[$i]->setQuantity($stockItemQuantity - $itemQuantity);
                    return null;
                } elseif ($stockItemQuantity === $itemQuantity) {
                    unset($this->stock[$i]);
                    return null;
                } else {
                    unset($this->stock[$i]);
                    $item->setQuantity($itemQuantity - $stockItemQuantity);
                    return $item;
                }
            }
        }
        return $item;
    }
}
