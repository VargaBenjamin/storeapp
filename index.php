<?php

require_once './storage.php';
require_once './storageDirector.php';
require_once './tv.php';
require_once './brand.php';
require_once './car.php';
require_once './book.php';

$eastStorage = new Storage('East Storage', 20);
$westStorage = new Storage('West Storage', 15);

$samsungBrand = new Brand('Samsung', 5);
$fordBrand = new Brand('Ford', 4);
$helikonBrand = new Brand('Helikon könyvkiadó', 3);

$neoQled = new TV('Neo QLED TV', 250000, $samsungBrand, 1234, 2, true, '4K');
$fairlane = new Car('Fairlane', 3000000, $fordBrand, 4321, 5, 5, 'red');
$harcosokKlubja = new Book('Harcosok Klubja könyv', 1990, $helikonBrand, 2341, 1, 'Chuck Palahniuk', 'Harcosok Klubja');

$samsungItems = new ProductItem($neoQled, 10);
$fordItems = new ProductItem($fairlane, 1);
$HKItems = new ProductItem($harcosokKlubja, 15);

$samsungItems->printAll();


