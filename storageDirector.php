<?php

declare(strict_types=1);

require_once './storage.php';
require_once './productItem.php';

class StorageDirector
{
    public static array $storages = [];

    public static function addStorage(Storage $storage): void
    {
        if (empty($storage)) {
            throw new Exception('Helytelen beviteli érték.', 1);
        }
        array_push(self::$storages, $storage);
    }

    public static function printAll(): void
    {
        array_map('self::printStorage', self::$storages);
    }

    private static function printStorage(Storage $storage): void
    {
        if (empty($storage)) {
            throw new Exception('Helytelen beviteli érték.', 1);
        }
        $storage->printAll();
    }

    public static function addProductItemToStorage(ProductItem $item, Storage $storage): void
    {
        if (empty($item) || empty($storage)) {
            throw new Exception('Helytelen beviteli érték.', 1);
        }
        $clonedItem = clone ($item);
        $result = $storage->addProduct($clonedItem);
        $count = count(self::$storages);
        $i = 0;
        if ($result != null) {
            while ($result != null && $i < $count) {
                $result = self::$storages[$i]->addProduct($clonedItem);
                $i++;
            }
            if ($result != null) {
                throw new Exception('Beillesztés: Nem sikerült mindegyik darabot elhelyezni a raktárakban! Maradt: ' . $clonedItem->getQuantity() . ' db ' . $clonedItem->getProduct()->getProductName() . ' (' . $clonedItem->getProduct()->getBrand()->getBrandName() . ')', 1);
            }
        }
    }

    public static function removeProductItemFromStorage(ProductItem $item, Storage $storage): void
    {
        if (empty($item) || empty($storage)) {
            throw new Exception('Helytelen beviteli érték.', 1);
        }
        $clonedItem = clone ($item);
        $result = $storage->removeProduct($clonedItem);
        $count = count(self::$storages);
        $i = 0;
        if ($result != null) {
            while ($result != null && $i < $count) {
                $result = self::$storages[$i]->removeProduct($clonedItem);
                $i++;
            }
            if ($result != null) {
                throw new Exception('Kivétel: Nem sikerült mindegyik darabot kivenni a raktárakból! Maradt: ' . $clonedItem->getQuantity() . ' db ' . $clonedItem->getProduct()->getProductName() . ' (' . $clonedItem->getProduct()->getBrand()->getBrandName() . ')', 1);
            }
        }
    }
}
