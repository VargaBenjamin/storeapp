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

    public function __construct(string $storageName, int $capacity) {
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

    protected function printProduct(ProductItem $item)
    {
        $item->printAll();
    }
}
