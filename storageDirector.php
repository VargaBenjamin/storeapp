<?php

declare(strict_types=1);

require_once './storage.php';
require_once './productItem.php';

class StorageDirector
{
    public static array $storages = [];
    protected static bool $continue = false;

    public static function addStorage(Storage $storage)
    {
        array_push(self::$storages, $storage);
    }

}
