<?php
declare(strict_types=1);

class Brand
{
    private static int $id=0;
    protected int $brandID;
    protected string $brandName;
    protected int $qualityRate;

    public function __construct(string $brandName, int $qualityRate) {
        $this->brandName = $brandName;
        $this->qualityRate = $qualityRate;
        $this->brandID = self::$id++;
        self::$id++;
    }

    public function printAll() {
        foreach ($this as $key => $value) {
            echo $key . ' = ' . $value . '<br>';
        }
    }
}
