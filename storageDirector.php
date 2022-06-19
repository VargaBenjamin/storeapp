<?php

declare(strict_types=1);

require_once './storage.php';
require_once './productItem.php';

class StorageDirector
{
    public static array $storages = [];

    public static function addStorage(Storage $storage)
    {
        array_push(self::$storages, $storage);
    }

    public static function printAll()
    {
        array_map('self::printStorage', self::$storages);
    }

    private static function printStorage(Storage $storage)
    {
        $storage->printAll();
    }

    public static function addProductItemToStorage(ProductItem $item, Storage $storage)
    {
        $result = $storage->addProduct($item);
        $count = count(self::$storages);
        $i = 0;
        if ($result != null) {
            while ($result != null && $i < $count) {
                $result = self::$storages[$i]->addProduct($item);
                $i++;
            }
            if ($result != null) {
                throw new Exception('Beillesztés: Nem sikerült mindegyik darabot elhelyezni a raktárakban!', 1);
            }
        }
    }
}
